<?php



namespace App\CPU;



use App\Model\Admin;

use App\Model\AdminWallet;

use App\Model\Cart;

use App\Model\CartShipping;

use App\Model\Order;

use App\Model\OrderDetail;

use App\Model\OrderTransaction;

use App\Model\Product;

use App\Model\Pincode;

use App\Model\Seller;

use App\Model\Coupon;

use App\Model\SellerWallet;

use App\Model\ShippingAddress;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use Brian2694\Toastr\Facades\Toastr;

use Carbon\Carbon;

use Illuminate\Support\Str;



class OrderManager

{

    public static function track_order($order_id)

    {

        return Order::where(['id' => $order_id])->first();

    }



    public static function gen_unique_id()

    {

        return rand(1000, 9999) . '-' . Str::random(5) . '-' . time();

    }



    public static function order_summary($order)

    {

        $sub_total = 0;

        $total_tax = 0;

        $total_discount_on_product = 0;

        foreach ($order->details as $key => $detail) {

            $sub_total += $detail->price * $detail->qty;

            $total_tax += $detail->tax;

            $total_discount_on_product += $detail->discount;

        }

        $total_shipping_cost = $order['shipping_cost'];

        return [

            'subtotal' => 0,

            'total_tax' => $total_tax,

            'total_discount_on_product' => $total_discount_on_product,

            'total_shipping_cost' => $total_shipping_cost,

        ];

    }



    public static function stock_update_on_order_status_change($order, $status)

    {

        if ($status == 'returned' || $status == 'failed' || $status == 'canceled') {

            foreach ($order->details as $detail) {

                if ($detail['is_stock_decreased'] == 1) {

                    $product = Product::find($detail['product_id']);

                    $type = $detail['variant'];

                    $var_store = [];

                    foreach (json_decode($product['variation'], true) as $var) {

                        if ($type == $var['type']) {

                            $var['qty'] += $detail['qty'];

                        }

                        array_push($var_store, $var);

                    }

                    Product::where(['id' => $product['id']])->update([

                        'variation' => json_encode($var_store),

                        'current_stock' => $product['current_stock'] + $detail['qty'],

                    ]);

                    OrderDetail::where(['id' => $detail['id']])->update([

                        'is_stock_decreased' => 0

                    ]);

                }

            }

        } else {

            foreach ($order->details as $detail) {

                if ($detail['is_stock_decreased'] == 0) {

                    $product = Product::find($detail['product_id']);



                    //check stock

                    /*foreach ($order->details as $c) {

                        $product = Product::find($c['product_id']);

                        $type = $detail['variant'];

                        foreach (json_decode($product['variation'], true) as $var) {

                            if ($type == $var['type'] && $var['qty'] < $c['qty']) {

                                Toastr::error('Stock is insufficient!');

                                return back();

                            }

                        }

                    }*/



                    $type = $detail['variant'];

                    $var_store = [];

                    foreach (json_decode($product['variation'], true) as $var) {

                        if ($type == $var['type']) {

                            $var['qty'] -= $detail['qty'];

                        }

                        array_push($var_store, $var);

                    }

                    Product::where(['id' => $product['id']])->update([

                        'variation' => json_encode($var_store),

                        'current_stock' => $product['current_stock'] - $detail['qty'],

                    ]);

                    OrderDetail::where(['id' => $detail['id']])->update([

                        'is_stock_decreased' => 1

                    ]);

                }

            }

        }

    }



    public static function wallet_manage_on_order_status_change($order, $received_by)

    {

        $order = Order::find($order['id']);

        $order_summary = OrderManager::order_summary($order);

        $order_amount = $order_summary['subtotal'] - $order_summary['total_discount_on_product'] - $order['discount_amount'];

        $commission = Helpers::sales_commission($order);

        $shipping_model = Helpers::get_business_settings('shipping_method');



        if (AdminWallet::where('admin_id', 1)->first() == false) {

            DB::table('admin_wallets')->insert([

                'admin_id' => 1,

                'withdrawn' => 0,

                'commission_earned' => 0,

                'inhouse_earning' => 0,

                'delivery_charge_earned' => 0,

                'pending_amount' => 0,

                'created_at' => now(),

                'updated_at' => now(),

            ]);

        }

        if (SellerWallet::where('seller_id', $order['seller_id'])->first() == false) {

            DB::table('seller_wallets')->insert([

                'seller_id' => $order['seller_id'],

                'withdrawn' => 0,

                'commission_given' => 0,

                'total_earning' => 0,

                'pending_withdraw' => 0,

                'delivery_charge_earned' => 0,

                'collected_cash' => 0,

                'created_at' => now(),

                'updated_at' => now(),

            ]);

        }



        if ($order['payment_method'] == 'cash_on_delivery') {

            DB::table('order_transactions')->insert([

                'transaction_id' => OrderManager::gen_unique_id(),

                'customer_id' => $order['customer_id'],

                'seller_id' => $order['seller_id'],

                'seller_is' => $order['seller_is'],

                'order_id' => $order['id'],

                'order_amount' => $order_amount,

                'seller_amount' => $order_amount - $commission,

                'admin_commission' => $commission,

                'received_by' => $received_by,

                'status' => 'disburse',

                'delivery_charge' => $order['shipping_cost'],

                'tax' => $order_summary['total_tax'],

                'delivered_by' => $received_by,

                'payment_method' => $order['payment_method'],

                'created_at' => now(),

                'updated_at' => now(),

            ]);



            $wallet = AdminWallet::where('admin_id', 1)->first();

            $wallet->commission_earned += $commission;

            if ($shipping_model == 'inhouse_shipping') {

                $wallet->delivery_charge_earned += $order['shipping_cost'];

            }

            $wallet->save();



            if ($order['seller_is'] == 'admin') {

                $wallet = AdminWallet::where('admin_id', 1)->first();

                $wallet->inhouse_earning += $order_amount;

                if ($shipping_model == 'sellerwise_shipping') {

                    $wallet->delivery_charge_earned += $order['shipping_cost'];

                }

                $wallet->total_tax_collected += $order_summary['total_tax'];

                $wallet->save();

            } else {

                $wallet = SellerWallet::where('seller_id', $order['seller_id'])->first();

                $wallet->commission_given += $commission;

                $wallet->total_tax_collected += $order_summary['total_tax'];



                if ($shipping_model == 'sellerwise_shipping') {

                    $wallet->delivery_charge_earned += $order['shipping_cost'];

                    $wallet->collected_cash += $order['order_amount']; //total order amount

                } else {

                    $wallet->total_earning += ($order_amount - $commission) + $order_summary['total_tax'];

                }



                $wallet->save();

            }

        } else {

            $transaction = OrderTransaction::where(['order_id' => $order['id']])->first();

            $transaction->status = 'disburse';

            $transaction->save();



            $wallet = AdminWallet::where('admin_id', 1)->first();

            $wallet->commission_earned += $commission;

            $wallet->pending_amount -= $order['order_amount'];

            if ($shipping_model == 'inhouse_shipping') {

                $wallet->delivery_charge_earned += $order['shipping_cost'];

            }

            $wallet->save();



            if ($order['seller_is'] == 'admin') {

                $wallet = AdminWallet::where('admin_id', 1)->first();

                $wallet->inhouse_earning += $order_amount;

                if ($shipping_model == 'sellerwise_shipping') {

                    $wallet->delivery_charge_earned += $order['shipping_cost'];

                }

                $wallet->total_tax_collected += $order_summary['total_tax'];

                $wallet->save();

            } else {

                $wallet = SellerWallet::where('seller_id', $order['seller_id'])->first();

                $wallet->commission_given += $commission;



                if ($shipping_model == 'sellerwise_shipping') {

                    $wallet->delivery_charge_earned += $order['shipping_cost'];

                    $wallet->total_earning += ($order_amount - $commission) + $order_summary['total_tax'] + $order['shipping_cost'];

                } else {

                    $wallet->total_earning += ($order_amount - $commission) + $order_summary['total_tax'];

                }



                $wallet->total_tax_collected += $order_summary['total_tax'];

                $wallet->save();

            }

        }

    }



    public static function generate_order($data)

    {

        $order_id = 100000 + Order::all()->count() + 1;

        if (Order::find($order_id)) {

            $order_id = Order::orderBy('id', 'DESC')->first()->id + 1;

        }

        $address_id = session('address_id') ? session('address_id') : null;

        $coupon_code = session()->has('coupon_code') ? session('coupon_code') : 0;

        $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;

        $discount1 = session()->has('coupon_discount') ? session('coupon_discount') : 0;



        $req = array_key_exists('request', $data) ? $data['request'] : null;

        if ($req != null) {

            if (session()->has('coupon_code') == false) {

                $coupon_code = $req->has('coupon_code') ? $req['coupon_code'] : null;

                $discount = $req->has('coupon_code') ? Helpers::coupon_discount($req) : $discount;

            }

            if (session()->has('address_id') == false) {

                $address_id = $req->has('address_id') ? $req['address_id'] : null;

            }

        }

        $user = Helpers::get_customer($req);



        if ($discount > 0) {

            $discount = round($discount / count(CartManager::get_cart_group_ids($req)), 2);

        }



        $cart_group_id = $data['cart_group_id'];

        $seller_data = Cart::where(['cart_group_id' => $cart_group_id])->first();





           $total = CartManager::cart_grand_total1($cart_group_id);

           

           if($total <= 1000)

           {

               $shipping_cost = CartManager::get_shipping_cost();

           }

           else

           {

               $shipping_cost = 0.00;

           }

           

            // $delivery_charge=DB::table('delivery_charge')->first();



            // if($total <= 1000)

            // {

            //     if(session()->has('address_id'))

            //     {

            //         $id=session()->get('address_id');

            //         $data=ShippingAddress::where('id',$id)->first();



            //         $pincode=DB::table('pincodes')->where('pincode',$data['zip'])->first();



            //         if(!empty($pincode))

            //         {

            //             $shipping_cost=$delivery_charge->delivery_charge;

            //         }

            //         else

            //         {

            //             $shipping_cost=$delivery_charge->delivery_charge_2;

            //         }

            //     }

            //     else

            //     {

            //         $shipping_cost=0.00;

            //     }

            // }

            // else

            // {

            //     $shipping_cost=0.00;

            // }

            

            

        $Coupon_data=Coupon::where('code',$coupon_code)->first();

        if(!empty($Coupon_data))

        {

            if($Coupon_data->seller_id == $seller_data->seller_id)

            {

                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $user->id,

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'payment_method' => $data['payment_method'],

                    'transaction_ref' => $data['transaction_ref'],

                    'order_group_id' => $data['order_group_id'],

                    'discount_amount' => $discount1,

                    'comman_id'=>$data['comman_id'],

                    'discount_type' => $discount1 == 0 ? null : 'coupon_discount',

                    'coupon_code' => $coupon_code,

                    'order_amount' => CartManager::cart_grand_total1($cart_group_id) - $discount1 + $shipping_cost,

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }

            elseif($Coupon_data->seller_id == '0' || $Coupon_data->seller_id == 0)

            {

                $discount2 = 0;

                $couponLimit = Order::where('customer_id', $user->id)

                    ->where('coupon_code', $coupon_code)->count();



                $coupon = Coupon::where(['code' => $coupon_code])

                    ->where('limit', '>', $couponLimit)

                    ->where('status', '=', 1)

                    ->whereDate('start_date', '<=', Carbon::parse()->toDateString())

                    ->whereDate('expire_date', '>=', Carbon::parse()->toDateString())->first();



                if (isset($coupon)) {



                    if($coupon['seller_id']=='0' || $coupon['seller_id']==0)

                    {

                        $total = CartManager::coupon_grand_total($cart_group_id);

                        if ($total >= $coupon['min_purchase']) {

                            if ($coupon['discount_type'] == 'percentage') {

                                $discount2 = (($total / 100) * $coupon['discount']) > $coupon['max_discount'] ? $coupon['max_discount'] : (($total / 100) * $coupon['discount']);

                            } else {

                                $discount2 = $coupon['discount'];

                            }

                        }

                    }else{



                        $total = 0;

                        foreach (CartManager::get_cart() as $cart) {

                            $product_subtotal = $cart['price'] * $cart['quantity'];

                            $total += $product_subtotal;

                        }

                        if ($total >= $coupon['min_purchase']) {

                            if ($coupon['discount_type'] == 'percentage') {

                                $discount2 = (($total / 100) * $coupon['discount']) > $coupon['max_discount'] ? $coupon['max_discount'] : (($total / 100) * $coupon['discount']);

                            } else {

                                $discount2 = $coupon['discount'];

                            }

                        }

                    }

                }





                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $user->id,

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'payment_method' => $data['payment_method'],

                    'transaction_ref' => $data['transaction_ref'],

                    'comman_id'=>$data['comman_id'],

                    'order_group_id' => $data['order_group_id'],

                    'discount_amount' => $discount2,

                    'discount_type' => $discount2 == 0 ? null : 'coupon_discount',

                    'coupon_code' => $coupon_code,

                    'order_amount' => CartManager::cart_grand_total1($cart_group_id) - $discount2 + $shipping_cost,

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }

            else

            {



                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $user->id,

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'payment_method' => $data['payment_method'],

                    'comman_id'=>$data['comman_id'],

                    'transaction_ref' => $data['transaction_ref'],

                    'order_group_id' => $data['order_group_id'],

                    'discount_amount' => 0,

                    'discount_type' => 0,

                    'coupon_code' => $coupon_code,

                    // 'order_amount' => CartManager::cart_grand_total1($cart_group_id) + $shipping_cost,

                    'order_amount' => CartManager::cart_grand_total1($cart_group_id),

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }

        }

        else

        {



            $or = [

                'id' => $order_id,

                'verification_code' => rand(100000, 999999),

                'customer_id' => $user->id,

                'seller_id' => $seller_data->seller_id,

                'seller_is' => $seller_data->seller_is,

                'customer_type' => 'customer',

                'payment_status' => $data['payment_status'],

                'order_status' => $data['order_status'],

                'payment_method' => $data['payment_method'],

                'transaction_ref' => $data['transaction_ref'],

                'comman_id'=>$data['comman_id'],

                'order_group_id' => $data['order_group_id'],

                'discount_amount' => $discount,

                'discount_type' => $discount == 0 ? null : 'coupon_discount',

                'coupon_code' => $coupon_code,

                'order_amount' => CartManager::cart_grand_total1($cart_group_id) - $discount + $shipping_cost,

                'shipping_address' => $address_id,

                'shipping_address_data' => ShippingAddress::find($address_id),

                'shipping_cost' => $shipping_cost,

                'shipping_method_id' => 0,

                'created_at' => now(),

                'updated_at' => now()

            ];

        }

        

         DB::table('orders')->insertGetId($or);



        foreach (CartManager::get_cart($data['cart_group_id']) as $c) {

            $product = Product::where(['id' => $c['product_id']])->first();

            $or_d = [

                'order_id' => $order_id,

                'product_id' => $c['product_id'],

                'seller_id' => $c['seller_id'],

                'product_details' => $product,

                'qty' => $c['quantity'],

                'price' => $c['price'],

                'tax' => $c['tax'] * $c['quantity'],

                'comman_id'=>$data['comman_id'],

                'discount' => $c['discount'] * $c['quantity'],

                'discount_type' => 'discount_on_product',

                'variant' => $c['variant'],

                'variation' => $c['variations'],

                'delivery_status' => 'pending',

                'shipping_method_id' => null,

                'payment_status' => 'unpaid',

                'shipping_cost' => $shipping_cost,

                'created_at' => now(),

                'updated_at' => now()

            ];



            if ($c['variant'] != null) {

                $type = $c['variant'];

                $var_store = [];

                foreach (json_decode($product['variation'], true) as $var) {

                    if ($type == $var['type']) {

                        $var['qty'] -= $c['quantity'];

                    }

                    array_push($var_store, $var);

                }

                Product::where(['id' => $product['id']])->update([

                    'variation' => json_encode($var_store),

                ]);

            }



            Product::where(['id' => $product['id']])->update([

                'current_stock' => $product['current_stock'] - $c['quantity']

            ]);



            DB::table('order_details')->insert($or_d);

        }



        if ($or['payment_method'] != 'cash_on_delivery') {

            $order = Order::find($order_id);

            $order_summary = OrderManager::order_summary($order);

            $order_amount = $order_summary['subtotal'] - $order_summary['total_discount_on_product'] - $order['discount'];

            $commission = Helpers::sales_commission($order);



            DB::table('order_transactions')->insert([

                'transaction_id' => OrderManager::gen_unique_id(),

                'customer_id' => $order['customer_id'],

                'seller_id' => $order['seller_id'],

                'seller_is' => $order['seller_is'],

                'order_id' => $order_id,

                'order_amount' => $order_amount,

                'seller_amount' => $order_amount - $commission,

                'admin_commission' => $commission,

                'received_by' => 'admin',

                'status' => 'hold',

                'delivery_charge' => $order['shipping_cost'],

                'tax' => $order_summary['total_tax'],

                'delivered_by' => 'admin',

                'payment_method' => $or['payment_method'],

                'created_at' => now(),

                'updated_at' => now(),

            ]);



            if (AdminWallet::where('admin_id', 1)->first() == false) {

                DB::table('admin_wallets')->insert([

                    'admin_id' => 1,

                    'withdrawn' => 0,

                    'commission_earned' => 0,

                    'inhouse_earning' => 0,

                    'delivery_charge_earned' => 0,

                    'pending_amount' => 0,

                    'created_at' => now(),

                    'updated_at' => now(),

                ]);

            }

            DB::table('admin_wallets')->where('admin_id', $order['seller_id'])->increment('pending_amount', $order['order_amount']);

        }



        try {

            $fcm_token = $user->cm_firebase_token;

            if ($data['payment_method'] != 'cash_on_delivery') {

                $value = Helpers::order_status_update_message('confirmed');

            } else {

                $value = Helpers::order_status_update_message('pending');

            }



            if ($value) {

                $data = [

                    'title' => translate('order'),

                    'description' => $value,

                    'order_id' => $order_id,

                    'image' => '',

                ];

                Helpers::send_push_notif_to_device($fcm_token, $data);

            }



            // Mail::to($user->email)->send(new \App\Mail\OrderPlaced($order_id));

            // if ($order['seller_is'] == 'seller') {

            //     $seller = Seller::where(['id' => $seller_data->seller_id])->first();

            // } else {

            //     $seller = Admin::where(['admin_role_id' => 1])->first();

            // }

            // Mail::to($seller->email)->send(new \App\Mail\OrderReceivedNotifySeller($order_id));



            // Mail::to('soapatopia@gmail.com')->send(new \App\Mail\OrderReceivedNotifySeller($order_id));



            $order_amt = DB::table('orders')->where('id',$order_id)->first()->order_amount;




            



        } catch (\Exception $exception) {

        }



        return $order_id;

    }



    public static function generate_order_mobile($data)

    {

        $order_id = 100000 + Order::all()->count() + 1;

        if (Order::find($order_id)) {

            $order_id = Order::orderBy('id', 'DESC')->first()->id + 1;

        }

        $address_id = $data['address_id'] ? $data['address_id'] : null;

        $coupon_code = 0;

        $discount = 0;



        $req = array_key_exists('request', $data) ? $data['request'] : null;

        if ($req != null) {

            if (session()->has('coupon_code') == false) {

                $coupon_code = $req->has('coupon_code') ? $req['coupon_code'] : null;

                $discount = $req->has('coupon_code') ? Helpers::coupon_discount($req) : $discount;

            }

            if (session()->has('address_id') == false) {

                $address_id = $req->has('address_id') ? $req['address_id'] : null;

            }

        }

        $user = Helpers::get_customer($req);



        if ($discount > 0) {

            $discount = round($discount / count(CartManager::get_cart_group_ids($req)), 2);

        }



        $cart_group_id = $data['cart_group_id'];

        $seller_data = Cart::where(['cart_group_id' => $cart_group_id])->first();



        $total = CartManager::cart_grand_total($cart_group_id) - 0;

       

        // $cost=DB::table('delivery_charge')->first();

        // $shipping_cost=$cost->delivery_charge;



        $total1 = CartManager::cart_grand_total($cart_group_id);

        

        $delivery_charge=DB::table('delivery_charge')->first();

        

        if($total1 <= 1000)

        {

            $sip_data=ShippingAddress::where('id',$data['address_id'])->first();



            $pincode1=DB::table('pincodes')->where('pincode',$sip_data['zip'])->first();



           if(!empty($pincode1))

            {

                $shipping_cost=$delivery_charge->delivery_charge;

            }

            else

            {

                $shipping_cost=$delivery_charge->delivery_charge_2;

            }

        }

        else

        {

            $shipping_cost = 0.00;

        }



        

        $Coupon_data=Coupon::where('code',$data['coupon_code'])->first();



        if(!empty($Coupon_data))

        {

            if($Coupon_data->seller_id == $seller_data->seller_id)

            {

                $order_amount = CartManager::cart_grand_total($cart_group_id) - $data['coupon_discount'] + $shipping_cost;

                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $data['user_id'],

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'comman_id'=>$data['comman_id'],

                    'payment_method' => $data['payment_method'],

                    'transaction_ref' => $data['transaction_ref'],

                    'order_group_id' => $data['order_group_id'],

                    'discount_amount' => $data['coupon_discount'],

                    'discount_type' => $data['coupon_discount'] == 0 ? null : $data['coupon_discount'],

                    'coupon_code' => $data['coupon_code'],

                    'instruction' => $data['instruction'],

                    'order_amount' => CartManager::cart_grand_total($cart_group_id) - $data['coupon_discount'] + $shipping_cost,

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }

            elseif($Coupon_data->seller_id == '0' || $Coupon_data->seller_id == 0)

            {

                $discount2 = 0;

                $couponLimit = Order::where('customer_id', $data['user_id'])

                    ->where('coupon_code', $data['coupon_code'])->count();



                $coupon = Coupon::where(['code' => $data['coupon_code']])

                    ->where('limit', '>', $couponLimit)

                    ->where('status', '=', 1)

                    ->whereDate('start_date', '<=', Carbon::parse()->toDateString())

                    ->whereDate('expire_date', '>=', Carbon::parse()->toDateString())->first();



                if (isset($coupon)) {



                    if($coupon['seller_id']=='0' || $coupon['seller_id']==0)

                    {

                        $total = CartManager::coupon_grand_total($cart_group_id);

                        if ($total >= $coupon['min_purchase']) {

                            if ($coupon['discount_type'] == 'percentage') {

                                $discount2 = (($total / 100) * $coupon['discount']) > $coupon['max_discount'] ? $coupon['max_discount'] : (($total / 100) * $coupon['discount']);

                            } else {

                                $discount2 = $coupon['discount'];

                            }

                        }

                    }else{



                        $total = 0;

                        foreach (CartManager::get_cart() as $cart) {

                            $product_subtotal = $cart['price'] * $cart['quantity'];

                            $total += $product_subtotal;

                        }

                        if ($total >= $coupon['min_purchase']) {

                            if ($coupon['discount_type'] == 'percentage') {

                                $discount2 = (($total / 100) * $coupon['discount']) > $coupon['max_discount'] ? $coupon['max_discount'] : (($total / 100) * $coupon['discount']);

                            } else {

                                $discount2 = $coupon['discount'];

                            }

                        }

                    }

                }



                $order_amount = CartManager::cart_grand_total($cart_group_id) - $discount2 + $shipping_cost;



                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $data['user_id'],

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'payment_method' => $data['payment_method'],

                    'transaction_ref' => $data['transaction_ref'],

                    'order_group_id' => $data['order_group_id'],

                    'discount_amount' => $discount2,

                    'comman_id'=>$data['comman_id'],

                    'discount_type' => $discount2,

                    'coupon_code' => $data['coupon_code'],

                    'instruction' => $data['instruction'],

                    'order_amount' => CartManager::cart_grand_total($cart_group_id) - $discount2 + $shipping_cost,

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }

            else

            {

                $order_amount = CartManager::cart_grand_total($cart_group_id) - 0 + $shipping_cost;



                $or = [

                    'id' => $order_id,

                    'verification_code' => rand(100000, 999999),

                    'customer_id' => $data['user_id'],

                    'seller_id' => $seller_data->seller_id,

                    'seller_is' => $seller_data->seller_is,

                    'customer_type' => 'customer',

                    'payment_status' => $data['payment_status'],

                    'order_status' => $data['order_status'],

                    'payment_method' => $data['payment_method'],

                    'transaction_ref' => $data['transaction_ref'],

                    'order_group_id' => $data['order_group_id'],

                    'instruction' => $data['instruction'],

                    'comman_id'=>$data['comman_id'],

                    'discount_amount' => 0,

                    'discount_type' => 0,

                    'coupon_code' => 0,

                    'order_amount' => CartManager::cart_grand_total($cart_group_id) - 0 + $shipping_cost,

                    'shipping_address' => $address_id,

                    'shipping_address_data' => ShippingAddress::find($address_id),

                    'shipping_cost' => $shipping_cost,

                    'shipping_method_id' => 0,

                    'created_at' => now(),

                    'updated_at' => now()

                ];

            }            

        }else

        {

            $order_amount = CartManager::cart_grand_total($cart_group_id) - $data['coupon_discount'] + $shipping_cost;



            $or = [

                'id' => $order_id,

                'verification_code' => rand(100000, 999999),

                'customer_id' => $data['user_id'],

                'seller_id' => $seller_data->seller_id,

                'seller_is' => $seller_data->seller_is,

                'customer_type' => 'customer',

                'payment_status' => $data['payment_status'],

                'order_status' => $data['order_status'],

                'payment_method' => $data['payment_method'],

                'transaction_ref' => $data['transaction_ref'],

                'order_group_id' => $data['order_group_id'],

                'comman_id'=>$data['comman_id'],

                'discount_amount' => $data['coupon_discount'],

                'discount_type' => $data['coupon_discount'] == 0 ? null : $data['coupon_discount'],

                'coupon_code' => $data['coupon_code'],

                'instruction' => $data['instruction'],

                'order_amount' => CartManager::cart_grand_total($cart_group_id) - $data['coupon_discount'] + $shipping_cost,

                'shipping_address' => $address_id,

                'shipping_address_data' => ShippingAddress::find($address_id),

                'shipping_cost' => $shipping_cost,

                'shipping_method_id' => 0,

                'created_at' => now(),

                'updated_at' => now()

            ];

        }

            



        $order_id = DB::table('orders')->insertGetId($or);



        foreach (CartManager::get_cart_mobile($data['cart_group_id']) as $c) {

            $product = Product::where(['id' => $c['product_id']])->first();

            $or_d = [

                'order_id' => $order_id,

                'product_id' => $c['product_id'],

                'seller_id' => $c['seller_id'],

                'product_details' => $product,

                'qty' => $c['quantity'],

                'price' => $c['price'],

                'tax' => $c['tax'] * $c['quantity'],

                'discount' => $c['discount'] * $c['quantity'],

                'discount_type' => 'discount_on_product',

                'variant' => $c['variant'],

                'variation' => $c['variations'],

                'comman_id'=>$data['comman_id'],

                'delivery_status' => 'pending',

                'shipping_method_id' => null,

                'payment_status' => 'unpaid',

                'shipping_cost' => $shipping_cost,

                'created_at' => now(),

                'updated_at' => now()

            ];



            if ($c['variant'] != null) {

                $type = $c['variant'];

                $var_store = [];

                foreach (json_decode($product['variation'], true) as $var) {

                    if ($type == $var['type']) {

                        $var['qty'] -= $c['quantity'];

                    }

                    array_push($var_store, $var);

                }

                Product::where(['id' => $product['id']])->update([

                    'variation' => json_encode($var_store),

                ]);

            }



            Product::where(['id' => $product['id']])->update([

                'current_stock' => $product['current_stock'] - $c['quantity']

            ]);



            DB::table('order_details')->insert($or_d);

        }



        if ($or['payment_method'] != 'cash_on_delivery') {

            $order = Order::find($order_id);

            $order_summary = OrderManager::order_summary($order);

            $order_amount = $order_summary['subtotal'] - $order_summary['total_discount_on_product'] - $order['discount'];

            $commission = Helpers::sales_commission($order);



            DB::table('order_transactions')->insert([

                'transaction_id' => OrderManager::gen_unique_id(),

                'customer_id' => $order['customer_id'],

                'seller_id' => $order['seller_id'],

                'seller_is' => $order['seller_is'],

                'order_id' => $order_id,

                'order_amount' => $order_amount,

                'seller_amount' => $order_amount - $commission,

                'admin_commission' => $commission,

                'received_by' => 'admin',

                'status' => 'hold',

                'delivery_charge' => $order['shipping_cost'],

                'tax' => $order_summary['total_tax'],

                'delivered_by' => 'admin',

                'payment_method' => $or['payment_method'],

                'created_at' => now(),

                'updated_at' => now(),

            ]);



            if (AdminWallet::where('admin_id', 1)->first() == false) {

                DB::table('admin_wallets')->insert([

                    'admin_id' => 1,

                    'withdrawn' => 0,

                    'commission_earned' => 0,

                    'inhouse_earning' => 0,

                    'delivery_charge_earned' => 0,

                    'pending_amount' => 0,

                    'created_at' => now(),

                    'updated_at' => now(),

                ]);

            }

            DB::table('admin_wallets')->where('admin_id', $order['seller_id'])->increment('pending_amount', $order['order_amount']);

        }

            

        try {

            $fcm_token = $user->cm_firebase_token;

            if ($data['payment_method'] != 'cash_on_delivery') {

                $value = Helpers::order_status_update_message('confirmed');

            } else {

                $value = Helpers::order_status_update_message('pending');

            }



            if ($value) {

                $data = [

                    'title' => translate('order'),

                    'description' => $value,

                    'order_id' => $order_id,

                    'image' => '',

                ];

                Helpers::send_push_notif_to_device($fcm_token, $data);

            }

        



            $user=User::where('id',$data['user_id'])->first();

            // Mail::to($user->email)->send(new \App\Mail\OrderPlaced($order_id));

            

            if ($order['seller_is'] == 'seller') {

                $seller = Seller::where(['id' => $seller_data->seller_id])->first();

            } else {

                $seller = Admin::where(['admin_role_id' => 1])->first();

            }

            // Mail::to($seller->email)->send(new \App\Mail\OrderReceivedNotifySeller($order_id));



            // Mail::to('soapatopia@gmail.com')->send(new \App\Mail\OrderReceivedNotifySeller($order_id));




                                        



        } catch (\Exception $exception) {

        }



        return $order_id;

    }

}


<?php



namespace App\Http\Controllers\Admin;



use App\CPU\Helpers;

use App\CPU\OrderManager;

use App\Http\Controllers\Controller;

use App\Model\Admin;

use App\Model\AdminWallet;

use App\Model\BusinessSetting;

use App\Model\Order;

use App\Model\OrderDetail;

use App\Model\OrderTransaction;

use App\Model\Product;

use App\Model\Seller;

use App\Model\SellerWallet;

use App\Model\Cart;

use App\Model\ShippingMethod;

use App\Model\Shop;

use App\Model\Notification;

use Barryvdh\DomPDF\Facade as PDF;

use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use function App\CPU\translate;





class OrderController extends Controller

{

    public function list(Request $request, $status)

    {

        $query_param = [];

        $search = $request['search'];

        if (session()->has('show_inhouse_orders') && session('show_inhouse_orders') == 1) {

            $query = Order::whereHas('details', function ($query) {

                $query->whereHas('product', function ($query) {

                    $query->where('added_by', 'admin');

                });

            })->with(['customer']);



            if ($status != 'all') {

                $orders = $query->where(['order_status' => $status]);

            } else {

                $orders = $query;

            }



            if ($request->has('search')) {

                $key = explode(' ', $request['search']);

                $orders = $orders->where(function ($q) use ($key) {

                    foreach ($key as $value) {

                        $q->orWhere('id', 'like', "%{$value}%")

                            ->orWhere('order_status', 'like', "%{$value}%")

                            ->orWhere('transaction_ref', 'like', "%{$value}%");

                    }

                });

                $query_param = ['search' => $request['search']];

            }



        } else {



            if ($status != 'all') {

                $orders = Order::with(['customer'])->where(['order_status' => $status]);

            } else {

                $orders = Order::with(['customer']);

            }



            if ($request->has('search')) {

                $key = explode(' ', $request['search']);

                $orders = $orders->where(function ($q) use ($key) {

                    foreach ($key as $value) {

                        $q->orWhere('id', 'like', "%{$value}%")

                            ->orWhere('order_status', 'like', "%{$value}%")

                            ->orWhere('transaction_ref', 'like', "%{$value}%");

                    }

                });

                $query_param = ['search' => $request['search']];

            }

        }



        $orders = $orders->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('admin-views.order.list', compact('orders', 'search'));

    }



    public function details($id)

    {

        $order = Order::with('details', 'shipping', 'seller')->where(['id' => $id])->first();

        $linked_orders = Order::where(['order_group_id' => $order['order_group_id']])

            ->whereNotIn('order_group_id', ['def-order-group'])

            ->whereNotIn('id', [$order['id']])

            ->get();

        return view('admin-views.order.order-details', compact('order', 'linked_orders'));

    }



    public function status(Request $request)

    {

        $order = Order::find($request->id);

        $fcm_token = $order->customer->cm_firebase_token;

        $cust_mno = $order->customer->phone;

        $cust_name = $order->customer->f_name;



        $notification = new Notification;

        $notification->title = $request->order_status;

        $notification->order_id = $order['id'];

        $notification->description = 'Your order '.$order['id'].' is '.$request->order_status;

        $notification->image = 'N/A';

        $notification->status = 1;

        $notification->save();



        $value = Helpers::order_status_update_message($request->order_status);

        try {

            if ($value) {



                $data = [

                    'title' => translate('Order'),

                    'description' => $value,

                    'order_id' => $order['id'],

                    'image' => '',

                ];

                Helpers::send_push_notif_to_device($fcm_token, $data);

            }

        } catch (\Exception $e) {

        }



        $order->order_status = $request->order_status;

        OrderManager::stock_update_on_order_status_change($order, $request->order_status);

        if($request->order_status == 'processing')

        {

            $order->processing_date = date('Y-m-d H:i:s');

        }

        if($request->order_status == 'out_for_delivery')

        {

            $order->out_for_delivery_date = date('Y-m-d H:i:s');

        }

        if($request->order_status == 'delivered')

        {

            $order->delivered_date = date('Y-m-d H:i:s');

        }

        $order->save(); 



        $transaction = OrderTransaction::where(['order_id' => $order['id']])->first();

        if (isset($transaction) && $transaction['status'] == 'disburse') {

            return response()->json($request->order_status);

        }



        if ($request->order_status == 'delivered' && $order['seller_id'] != null) {

            OrderManager::wallet_manage_on_order_status_change($order, 'admin');



        }



        if ($request->order_status == 'canceled' && $order['seller_id'] != null) {

            


        }



        return response()->json($request->order_status);

    }



    public function payment_status(Request $request)

    {

        if ($request->ajax()) {

            $order = Order::find($request->id);

            $order->payment_status = $request->payment_status;

            $order->save();

            $data = $request->payment_status;

            return response()->json($data);

        }

    }



    public function generate_invoice($id)

    {

        $order = order::with('shipping')->with('details')->where('id', $id)->first();

        // print_r($order);

        // $seller = Seller::findOrFail($order->details->first()->seller_id);

        $data["email"] = $order->customer["email"];

        $data["client_name"] = $order->customer["f_name"] . ' ' . $order->customer["l_name"];

        $data["order"] = $order;

        

        return view('admin-views.order.invoice',compact('order'));

        



        // $mpdf_view = \View::make('admin-views.order.invoice')->with('order', $order)->with('seller', $seller);

        // // print_r($mpdf_view);

        // Helpers::gen_mpdf($mpdf_view, 'order_invoice_', $order->id);

    }

    

    public function inhouse_order_filter()

    {

        if (session()->has('show_inhouse_orders') && session('show_inhouse_orders') == 1) {

            session()->put('show_inhouse_orders', 0);

        } else {

            session()->put('show_inhouse_orders', 1);

        }

        return back();

    }

    

    public function order_report()

    {

        return view('admin-views.order.report');

    }

    

    public function report_ganrate(Request $request)

    {

        $order_status=$request->order_status;

        $end_date=$request->end_date;

        $start_date=$request->start_date;

        $seller_id=$request->seller_id;

        $pincode=$request->pincode;



            if($request->seller_id=='all' || $request->seller_id=='')

            {

                if($request->order_status=='all' || $request->order_status=='')

                {

                    $order = Order::with(['customer'])->with('shippingAddress')->get();

                }

                else

                {

                    $order = Order::with(['customer'])->with('shippingAddress')->where('order_status',$request->order_status)->get();

                }

            }

            else

            {

                if($request->order_status=='all' || $request->order_status=='')

                {

                    $order = Order::with(['customer'])->with('shippingAddress')->where('seller_id',$request->seller_id)->get();

                }

                else

                {

                    $order = Order::with(['customer'])->with('shippingAddress')->where('seller_id',$request->seller_id)->where('order_status',$request->order_status)->get();

                }

            }

        

       

       

        foreach($order as $val)

        {

            $data=date_format($val['created_at'],"Y-m-d");

            $user=DB::table('users')->where('id',$val['customer_id'])->first();



            if(!empty($pincode))

            {

                if($pincode==$val->shippingAddress['zip'])

                {

                    if($data >= $request->start_date && $data <= $request->end_date)

                    {

                        $ary['id']=$val['id'];

                        $ary['shipping_cost']=$val['shipping_cost'];

                        $ary['order_amount']=$val['order_amount'];

                        $ary['created_at']=$val['created_at'];

                        $ary['customer_id']=$val['customer_id'];

                        $ary['payment_status']=$val['payment_status'];

                        $ary['zip']=$val->shippingAddress['zip'];

                        $ary['name']=$user->f_name.' '.$user->l_name;

                        $ary['order_status']=$val['order_status'];

                        $data1[]=$ary;

        

                    }

                    else

                    {

                        $ary=array();

                        $data1=$ary;

                    }

                }

                

            }

            else

            {

                if($data >= $request->start_date && $data <= $request->end_date)

                {

                    $ary['id']=$val['id'];

                    $ary['shipping_cost']=$val['shipping_cost'];

                    $ary['order_amount']=$val['order_amount'];

                    $ary['created_at']=$val['created_at'];

                    $ary['customer_id']=$val['customer_id'];

                    $ary['payment_status']=$val['payment_status'];

                    $ary['zip']=$val->shippingAddress['zip'];

                    $ary['name']=$user->f_name.' '.$user->l_name;

                    $ary['order_status']=$val['order_status'];

                    $data1[]=$ary;

    

                }

                else

                {

                    $ary=array();

                    $data1=$ary;

                }

            }

            

        }





         return view('admin-views.order.report')->with('data1',$data1)->with('order_status',$order_status)->with('end_date',$end_date)->with('start_date',$start_date)->with('seller_id',$seller_id)->with('pincode',$pincode);



    }

    public function report_ganrate_pdf(Request $request)

    {

        $seller_id=$request->seller_id;

        $pincode=$request->pincode;



        if($request->seller_id=='all' || $request->seller_id=='')

        {

            if($request->order_status=='all' || $request->order_status=='')

            {

                $order = Order::with(['customer'])->get();

            }

            else

            {

                $order = Order::with(['customer'])->where('order_status',$request->order_status)->get();

            }

        }

        else

        {

            if($request->order_status=='all' || $request->order_status=='')

            {

                $order = Order::with(['customer'])->where('seller_id',$request->seller_id)->get();

            }

            else

            {

                $order = Order::with(['customer'])->where('seller_id',$request->seller_id)->where('order_status',$request->order_status)->get();

            }

        }

        foreach($order as $val)

        {

            $data=date_format($val['created_at'],"Y-m-d");

            $user=DB::table('users')->where('id',$val['customer_id'])->first();



            if(!empty($pincode))

            {

                if($pincode==$val->shippingAddress['zip'])

                {

                    if($data >= $request->start_date && $data <= $request->end_date)

                    {

                        $ary['id']=$val['id'];

                        $ary['shipping_cost']=$val['shipping_cost'];

                        $ary['order_amount']=$val['order_amount'];

                        $ary['created_at']=$val['created_at'];

                        $ary['customer_id']=$val['customer_id'];

                        $ary['payment_status']=$val['payment_status'];

                        $ary['zip']=$val->shippingAddress['zip'];

                        $ary['name']=$user->f_name.' '.$user->l_name;

                        $ary['order_status']=$val['order_status'];

                        $data1[]=$ary;

        

                    }

                    else

                    {

                        $ary=array();

                        $data1=$ary;

                    }

                }

                

            }

            else

            {

                if($data >= $request->start_date && $data <= $request->end_date)

                {

                    $ary['id']=$val['id'];

                    $ary['shipping_cost']=$val['shipping_cost'];

                    $ary['order_amount']=$val['order_amount'];

                    $ary['created_at']=$val['created_at'];

                    $ary['customer_id']=$val['customer_id'];

                    $ary['payment_status']=$val['payment_status'];

                    $ary['zip']=$val->shippingAddress['zip'];

                    $ary['name']=$user->f_name.' '.$user->l_name;

                    $ary['order_status']=$val['order_status'];

                    $data1[]=$ary;

    

                }

                else

                {

                    $ary=array();

                    $data1=$ary;

                }

            }

            

        }

         $mpdf_view = \View::make('admin-views.order.order_report')->with('data1', $data1);

         Helpers::gen_mpdf($mpdf_view, 'order_invoice_', $request->order_status); 

    }

    

    public function incomplete_order(Request $request)

    {

        $query_param = [];

        $search = $request['search'];

        $orders = Cart::with(['product']);

        



        if ($request->has('search')) {

            $key = explode(' ', $request['search']);

            $orders = $orders->where(function ($q) use ($key) {

                foreach ($key as $value) {

                    $q->orWhere('id', 'like', "%{$value}%")

                    ->orWhere('shop_info', 'like', "%{$value}%")

                    ->orWhere('name', 'like', "%{$value}%");

                }

            });

            $query_param = ['search' => $request['search']];

        }

        

        $orders = $orders->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

        return view('admin-views.order.incomplete_order', compact('orders', 'search'));

    }



    public function update_awb(Request $request)

    {

        Order::where('id',$request->order_id)->update(array('awb_id'=>$request->awb_id,'order_status'=>'out_for_delivery'));



        $order = Order::find($request->order_id);

        $fcm_token = $order->customer->cm_firebase_token;

        $cust_mno = $order->customer->phone;

        $cust_name = $order->customer->f_name;

        // $value = Helpers::order_status_update_message($request->order_status);

        try {

            // if ($value) {

                $data = [

                    'title' => translate('Order'),

                    'description' => 'Your order '.$order['id'].' is out for delivery.your tracking id '.$order['awb_id'].' and tracking url: https://soapatopia.shiprocket.co/tracking/',

                    'order_id' => $order['id'],

                    'image' => '',

                ];

                Helpers::send_push_notif_to_device($fcm_token, $data);



                $notification = new Notification;

                $notification->title = 'Out for delivery';

                $notification->order_id = $order['id'];

                $notification->description = 'Your order '.$order['id'].' is out for delivery.your tracking id '.$order['awb_id'].' and tracking url: https://soapatopia.shiprocket.co/tracking/';

                $notification->image = 'N/A';

                $notification->status = 1;

                $notification->save();



               

            // }

        } catch (\Exception $e) {

        }



        Toastr::success('Status Change successfully');

        return back();

        

    }

}


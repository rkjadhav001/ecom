<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\CPU\Convert;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class CouponController extends Controller
{
    public function add_new(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $cou = Coupon::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%")
                        ->orWhere('code', 'like', "%{$value}%")
                        ->orWhere('discount_type', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $cou = new Coupon();
        }
        
        $cou = $cou->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.coupon.add-new', compact('cou','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'discount' => 'required',
            'min_purchase' => 'required',
            'limit' => 'required',
        ], [
            'code.required' => 'Coupon code is required!',
            'title.required' => 'Coupon title is required!',
            'start_date.required' => 'Coupon start date is required!',
            'expire_date.required' => 'Coupon expire date is required!',
            'discount.required' => 'Coupon discount is required!',
            'min_purchase.required' => 'Coupon minimum purchase is required!',
            'limit.required' => 'Coupon limit purchase is required!',
        ]);

        // $coupon = new Coupon;
        // $coupon->coupon_type = $request->coupon_type;
        // $coupon->title = $request->title;
        // $coupon->code = $request->code;
        // $coupon->start_date = $request->start_date;
        // $coupon->expire_date = $request->expire_date;
        // $coupon->min_purchase = $request->min_purchase;
        // $coupon->max_discount = $request->max_discount;
        // $coupon->discount = $request->discount_type == 'amount' ?           $request->discount : $request['discount'];
        // $coupon->discount_type = $request->discount_type;
        // $coupon->icon = ImageManager::upload('banner/', 'png', $request->file('coupon_image'));
        // $coupon->status = 1;
        // $coupon->created_at = now();
        // $coupon->updated_at = now();
        // $coupon->limit = $request->limit;
        // $coupon->seller_id = $request->seller_id;
        // $coupon->save();
        // $input=$request->all();

        // $data=$request->file('coupon_image');
        
        // print_r($input);
        
            // $image=ImageManager::upload('notification/', 'png', $request->file('image'));
        
            DB::table('coupons')->insert([
                'coupon_type' => $request->coupon_type,
                'title' => $request->title,
                'code' => $request->code,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
                'min_purchase' => $request->min_purchase,
                'max_discount' => $request->max_discount,
                'discount' => $request->discount_type == 'amount' ? $request->discount : $request['discount'],
                'discount_type' => $request->discount_type,
                'image'=> ImageManager::upload('notification/', 'png', $request->file('image')),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'limit' =>$request->limit,
                'seller_id' =>$request->seller_id,
            ]);
            
            $user = User::where('is_active',1)->get();
            foreach($user as $u)
            {
                $fcm_token = $u->cm_firebase_token;
        
                $data = [
                    'title' => 'Soapatopia',
                    'description' => 'New offer added',
                    'image' => '',
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);
            }
        

        // $data = [
        //     'title' => $request->title,
        //     'description' => "Chack Out New Offer Avalable On Vaidik Basket",
        //     'image' => $image,
        //     'order_id' => '',
        // ];

        // Helpers::send_push_notif_to_coupon($data);
        
        Toastr::success('Coupon added successfully!');
        return back();
    }

    public function edit($id)
    {
        $c = Coupon::where(['id' => $id])->first();
        return view('admin-views.coupon.edit', compact('c'));
    }

    public function update(Request $request, $id)
    {
        // $data=$request->file('coupon_image');
        // print_r($data);
        $request->validate([
            'code' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'expire_date' => 'required',
            'discount' => 'required',
            'min_purchase' => 'required',
            'limit' => 'required',
        ]);

        if($request->file('coupon_image'))
        {
            $image=ImageManager::upload('notification/', 'png', $request->file('coupon_image'));

            DB::table('coupons')->where(['id' => $id])->update([
                'coupon_type' => $request->coupon_type,
                'title' => $request->title,
                'code' => $request->code,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
                'min_purchase' => $request->min_purchase,
                'image'=> $image,
                'max_discount' => $request->max_discount,
                'discount' => $request->discount_type == 'amount' ? $request->discount : $request['discount'],
                'discount_type' => $request->discount_type,
                'updated_at' => now(),
                'limit' =>$request->limit,
                'seller_id' =>$request->seller_id,
            ]);

        }
        else
        {
            DB::table('coupons')->where(['id' => $id])->update([
                'coupon_type' => $request->coupon_type,
                'title' => $request->title,
                'code' => $request->code,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
                'min_purchase' => $request->min_purchase,
                'max_discount' => $request->max_discount,
                'discount' => $request->discount_type == 'amount' ? $request->discount : $request['discount'],
                'discount_type' => $request->discount_type,
                'updated_at' => now(),
                'limit' =>$request->limit,
                'seller_id' =>$request->seller_id,
            ]);
        }

        // echo $request->min_purchase;

        Toastr::success('Coupon updated successfully!');
        return back();
    }

    public function status(Request $request)
    {
        $coupon = Coupon::find($request->id);
        $coupon->status = $request->status;
        $coupon->save();
        // $data = $request->status;
        // return response()->json($data);
        Toastr::success('Coupon status updated!');
        return back();
    }
}

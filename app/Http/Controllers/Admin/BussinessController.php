<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Bussiness;
use App\Model\BussinessImage;
use App\Model\BussinessRadius;
use App\Model\Feedback;
use App\Model\Order;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BussinessController extends Controller
{
    public function bussiness_list(Request $request)
    {
        // return 'wokring';
        $query_param = [];
        $search = $request['search'];
        $to_date = $request['to_date'];
        $from_date = $request['from_date'];
        $old_to_date = $request['to_date'];
        $old_from_date = $request['from_date'];

        // Convert date strings to timestamp format
        $from_date = Carbon::parse($from_date)->startOfDay()->toDateTimeString();
        $to_date = Carbon::parse($to_date)->endOfDay()->toDateTimeString();

        // $bussiness = Bussiness::where('status', '1')->orWhere('status', '0');

        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $bussiness = Bussiness::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('country', 'like', "%{$value}%")
                        ->orWhere('state', 'like', "%{$value}%")
                        ->orWhere('city', 'like', "%{$value}%")
                        ->orWhere('address', 'like', "%{$value}%")
                        ->orWhere('mobile', 'like', "%{$value}%")
                        ->orWhere('whatsapp_number', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $bussiness = Bussiness::query(); // Initialize query if no search
        }
        
        if ($request->has('from_date') && $request->has('to_date')) {
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            
            // Apply date filter to the existing query
            $bussiness->whereBetween('created_at', [$from_date, $to_date]);
            $query_param['from_date'] = $from_date;
            $query_param['to_date'] = $to_date;
        }
           
        $bussiness->whereIn('status', ['0', '1']); // Handles both 0 and 1
        
        

        $bussiness = $bussiness->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        // return $bussiness;
        
        return view('admin-views.bussiness.list', compact('bussiness', 'search', 'old_from_date', 'old_to_date'));
        
    }
    
  
    public function status_update(Request $request)
    {
        Bussiness::where(['id' => $request['id']])->update([
            'status' => $request['status']
        ]);

        Toastr::success('Status updated successfully!');

        return response()->json([], 200);
    }

    public function view(Request $request, $id)
    {
        $customer = User::find($id);
        if (isset($customer)) {
            $query_param = [];
            $search = $request['search'];
            $orders = Order::where(['customer_id' => $id]);
            if ($request->has('search')) {

                $orders = $orders->where('id', 'like', "%{$search}%");
                $query_param = ['search' => $request['search']];
            }
            $orders = $orders->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
            return view('admin-views.customer.customer-view', compact('customer', 'orders', 'search'));
        }
        Toastr::error('Customer not found!');
        return back();
    }

    public function view_bussiness_image(Request $request, $id)
    {
        // return 'sd';
        $BussinessImages = BussinessImage::where('bussiness_id',$id)->get();
        return view('admin-views.bussiness.shop-all-image', compact('BussinessImages'));
    }

    public function bussiness_radius(Request $request)
    {
      
        $bussiness= BussinessRadius::where('id','1')->firstorFail();
       
        return view('admin-views.bussiness.radius', compact('bussiness'));
    }

    public function update_bussiness_radius(Request $request)
    {
        BussinessRadius::where('id','1')->update([
            'radius' => $request['radius']
        ]);

        Toastr::success('Bussiness Radius updated successfully!');

        return back();
    }
}

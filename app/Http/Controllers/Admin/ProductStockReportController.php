<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class ProductStockReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('seller_id') == false || $request['seller_id'] == 'all') {
            $query = Product::whereIn('added_by', ['admin', 'seller']);
        } elseif ($request['seller_id'] == 'in_house') {
            $query = Product::where(['added_by' => 'admin']);
        } else {
            $query = Product::where(['added_by' => 'seller', 'user_id' => $request['seller_id']]);
        }

        $query_param = ['seller_id' => $request['seller_id']];
        $products = $query->paginate(Helpers::pagination_limit())->appends($query_param);
        $seller_is = $request['seller_id'];
        return view('admin-views.report.product-stock', compact('products','seller_is'));
    }
    
    public function delivery_charge()
    {
        return view('admin-views.report.delivery_charge');
    }
    
    public function submit(Request $request)
    {
        DB::table('delivery_charge')->where('id','1')->update(['delivery_charge'=>$request->delivery_charge,'delivery_charge_2'=>$request->delivery_charge_2]);
        Toastr::success('Updated!');
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class Product_discount_Controller extends Controller
{
    public function index(Request $request)
    {
        return view('admin-views.product.Product_discount');
    }

    public function update_charge(Request $request)
    {
        DB::table('product_discount')->where('id','1')->update(['range_1'=>$request->range_1,'range_2'=>$request->range_2,'range_3'=>$request->range_3]);

        Toastr::success('Updated !');

        return redirect()->back();
    }
    


}

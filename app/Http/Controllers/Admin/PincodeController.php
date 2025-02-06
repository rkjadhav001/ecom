<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Pincode;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;

class PincodeController extends Controller
{
    public function add_new()
    {
        $br = Pincode::latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.pincode.add-new', compact('br'));
    }

    public function store(Request $request)
    {
        $brand = new Pincode;
        $brand->pincode = $request->pincode[array_search('en', $request->lang)];
        $brand->charge = $request->charge[array_search('en', $request->lang)];
        $brand->status = 1;
        $brand->save();

        // foreach($request->lang as $index=>$key)
        // {
        //     if($request->name[$index] && $key != 'en')
        //     {
        //         Translation::updateOrInsert(
        //             ['translationable_type'  => 'App\Model\Pincode',
        //                 'translationable_id'    => $brand->id,
        //                 'locale'                => $key,
        //                 'key'                   => 'name'],
        //             ['value'                 => $request->name[$index]]
        //         );
        //     }
        // }
        Toastr::success('Pincode added successfully!');
        return back();
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $br = Pincode::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('pincode', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $br = new Pincode();
        }
        $br = $br->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.pincode.list', compact('br','search'));
    }

    public function edit($id)
    {
        $b = Pincode::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.pincode.edit', compact('b'));
    }

    public function update(Request $request, $id)
    {

        $brand = Pincode::find($id);
        $brand->pincode = $request->pincode[array_search('en', $request->lang)];
        $brand->charge = $request->charge[array_search('en', $request->lang)];
        $brand->save();
        // foreach ($request->lang as $index => $key) {
        //     if ($request->name[$index] && $key != 'en') {
        //         Translation::updateOrInsert(
        //             ['translationable_type' => 'App\Model\Pincode',
        //                 'translationable_id' => $brand->id,
        //                 'locale' => $key,
        //                 'key' => 'name'],
        //             ['value' => $request->name[$index]]
        //         );
        //     }
        // }

        Toastr::success('Pincode updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Pincode')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        $brand = Pincode::find($request->id);
        $brand->delete();
        return response()->json();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\City;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;

class CityController extends Controller
{
    public function add_new()
    {
        $br = City::latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.city.add-new', compact('br'));
    }

    public function store(Request $request)
    {
        $brand = new City;
        $brand->name = $request->name[array_search('en', $request->lang)];
        $brand->percent = $request->percent[array_search('en', $request->lang)];
        $brand->status = 1;
        $brand->save();

        Toastr::success('City added successfully!');
        return back();
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $br = City::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $br = new City();
        }
        $br = $br->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.city.list', compact('br','search'));
    }

    public function edit($id)
    {
        $b = City::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.city.edit', compact('b'));
    }

    public function update(Request $request, $id)
    {

        $brand = City::find($id);
        $brand->name = $request->name[array_search('en', $request->lang)];
        $brand->percent = $request->percent[array_search('en', $request->lang)];
        $brand->save();
      
        Toastr::success('City updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $brand = City::find($request->id);
        $brand->delete();
        return response()->json();
    }
}

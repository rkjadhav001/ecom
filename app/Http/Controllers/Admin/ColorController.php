<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Color;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;

class ColorController extends Controller
{
    public function add_new()
    {
        $br = Color::latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.color.add-new', compact('br'));
    }

    public function store(Request $request)
    {
        $brand = new Color();
        $brand->name = $request->name;
        $brand->code = $request->code;
        $brand->save();

        Toastr::success('Color added successfully!');
        return back();
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $br = Color::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%")->orWhere('code', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $br = new Color();
        }
        $br = $br->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.color.list', compact('br','search'));
    }

    public function edit($id)
    {
        $b = Color::where(['id' => $id])->first();
        return view('admin-views.color.edit', compact('b'));
    }

    public function update(Request $request, $id)
    {

        $brand = Color::find($id);
        $brand->name = $request->name;
        $brand->code = $request->code;
        $brand->save();
      
        Toastr::success('Color updated successfully!');
        return redirect()->route('admin.color.list');
    }

    public function delete(Request $request)
    {
        $brand = Color::find($request->id);
        $brand->delete();
        return response()->json();
    }
}

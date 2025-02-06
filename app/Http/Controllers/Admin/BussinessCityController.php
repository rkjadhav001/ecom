<?php



namespace App\Http\Controllers\Admin;



use App\CPU\Helpers;

use App\Http\Controllers\Controller;
use App\Model\BussinessCity;
use App\Model\City;

use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;



class BussinessCityController extends Controller

{

    public function add_new()
    {
        $cities = BussinessCity::get();
        $uniqueStates = $cities->pluck('city_state')->unique();
        // return $uniqueStates;       
        return view('admin-views.BussinessCity.add-new', compact('uniqueStates'));
    }



    public function store(Request $request)
    {
        // return $request->all();
        $checkduplicate= BussinessCity::where('city_name',$request->city_name)->first();
        
        if($checkduplicate)
        {
            Toastr::error('City already exist', 'Error');
            return redirect()->back();
        }
       
        $BussinessCity = new BussinessCity();
        $BussinessCity->city_name = $request->city_name;
        $BussinessCity->city_state = $request->city_state;
        $BussinessCity->save();
        
        Toastr::success('City added successfully!');

        return redirect()->route('admin.bussinesscity.list');
    }



    function list(Request $request)
    {
        
        $BussinessCity = BussinessCity::get();
        if($request->search)
        {
            $BussinessCity = BussinessCity::where('city_name',$request->search)->get();
        }
        $search = '';
       

        return view('admin-views.BussinessCity.list', compact('BussinessCity','search'));
    }



    // public function edit($id)

    // {

    //     $b = City::where(['id' => $id])->withoutGlobalScopes()->first();

    //     return view('admin-views.city.edit', compact('b'));

    // }



    // public function update(Request $request, $id)

    // {



    //     $brand = City::find($id);

    //     $brand->name = $request->name[array_search('en', $request->lang)];

    //     $brand->percent = $request->percent[array_search('en', $request->lang)];

    //     $brand->save();

      

    //     Toastr::success('City updated successfully!');

    //     return back();

    // }



    // public function delete(Request $request)

    // {

    //     $brand = City::find($request->id);

    //     $brand->delete();

    //     return response()->json();

    // }

}


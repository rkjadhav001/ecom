<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\AdminRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function add_new()
    {
        $rls = AdminRole::whereNotIn('id', [1])->get();
        return view('admin-views.employee.add-new', compact('rls'));
    }

    public function store(Request $request)
    {
        // return 'working';
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'image' => 'required',
            'email' => 'required|email',

        ], [
            'name.required' => 'Role name is required!',
            'role_name.required' => 'Role id is Required',
            'email.required' => 'Email id is Required',
            'image.required' => 'Image is Required',

        ]);

        if ($request->role_id == 1) {
            Toastr::warning('Access Denied!');
            return back();
        }
        $check_duplicate= Admin::where('email',$request->email)->whereNotIn('id', [1])->first();
        if($check_duplicate){
            Toastr::error('Email already exists!');
            return back();
        }
        $check_duplicate= Admin::where('phone',$request->phone)->whereNotIn('id', [1])->first();
        if($check_duplicate){
            Toastr::error('Phone No. already exists!');
            return back();
        }
        if(!is_numeric($request->phone) || strlen($request->phone) != 10)
        {
            Toastr::error('Phone number must be 10 digits!');
            return back();
        }

        $fileName='';
        if ($request->image) {
            $uploadFile = $request->file('image');
            $fileName = $uploadFile->hashName();
            $path = $uploadFile->move('admin',$fileName);
        }
        DB::table('admins')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'admin_role_id' => $request->role_id,
            'password' => bcrypt($request->password),
            'image' => $fileName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Toastr::success('Employee added successfully!');
        return redirect()->route('admin.employee.list');
    }

    function list()
    {
        $em = Admin::with(['role'])->whereNotIn('id', [1])->paginate(Helpers::pagination_limit());
        return view('admin-views.employee.list', compact('em'));
    }

    public function edit($id)
    {
        $e = Admin::where(['id' => $id])->first();
        $rls = AdminRole::whereNotIn('id', [1])->get();
        return view('admin-views.employee.edit', compact('rls', 'e'));
    }

    public function delete(Request $request)
    {
        $e = Admin::where(['id' => $request->id])->first();
        $e->delete();
        Toastr::success('Employee deleted successfully!');
        return back();
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
        ], [
            'name.required' => 'Role name is required!',
        ]);

        $check_duplicate= Admin::where('email',$request->email)->whereNotIn('id', [1,$id])->first();
        if($check_duplicate){
            Toastr::error('Email already exists!');
            return back();
        }
        $check_duplicate= Admin::where('phone',$request->phone)->whereNotIn('id', [1,$id])->first();
        if($check_duplicate){
            Toastr::error('Phone No. already exists!');
            return back();
        }

        if ($request->role_id == 1) {
            Toastr::warning('Access Denied!');
            return back();
        }

        $e = Admin::find($id);
        if ($request['password'] == null) {
            $pass = $e['password'];
        } else {
            // if (strlen($request['password']) < 7) {
            //     Toastr::warning('Password length must be 8 character.');
            //     return back();
            // }
            $pass = bcrypt($request['password']);
        }

        

        $fileName='';
        if ($request->image) {
            $uploadFile = $request->file('image');
            $fileName = $uploadFile->hashName();
            $path = $uploadFile->move('admin',$fileName);

            DB::table('admins')->where(['id' => $id])->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'admin_role_id' => $request->role_id,
                'password' => $pass,
                'image' => $fileName,
                'updated_at' => now(),
            ]);
        }
        else{
            DB::table('admins')->where(['id' => $id])->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'admin_role_id' => $request->role_id,
                'password' => $pass,
                'updated_at' => now(),
            ]);
        }

        Toastr::success('Employee updated successfully!');
        return back();
    }
    public function update_status($id)
    {
        $e = Admin::where(['id' => $id])->first();
        if ($e['status'] == 1) {
            $e['status'] = 0;
            } else {
                $e['status'] = 1;
                }
        DB::table('admins')->where(['id' => $id])->update([
                    'status' => $e['status'],
                    'updated_at' => now(),
                    ]);
        Toastr::success('Employee status updated successfully!');
        return back();
    }

    public function city_status(Request $request)
    {
        $employee = Admin::where(['id' => $request['id']])->first();
        $employee->is_city = $request['status'];
        $employee->save();

        Toastr::success('City Status updated successfully!');

        return response()->json([], 200);
    }
}

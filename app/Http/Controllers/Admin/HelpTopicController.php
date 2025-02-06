<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\HelpTopic;
use App\CPU\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelpTopicController extends Controller
{
    public function add_new()
    {
        return view('admin-views.help-topics.add-new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
        ], [
            'question.required' => 'Question name is required!',
            'answer.required'   => 'Question answer is required!',

        ]);
        $helps = new HelpTopic;
        $helps->question = $request->question;
        $helps->answer = $request->answer;
        $helps->save();

        Toastr::success('FAQ added successfully!');
        return back();
    }
    public function status($id)
    {

        $helps = HelpTopic::findOrFail($id);
        if ($helps->status == 1) {
            $helps->update(["status" => 0]);

        } else {
            $helps->update(["status" => 1]);

        }
        return response()->json(['success' => 'Status Change']);

    }
    public function edit($id)
    {
        $helps = HelpTopic::findOrFail($id);
        return response()->json($helps);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
        ], [
            'question.required' => 'Question name is required!',
            'answer.required'   => 'Question answer is required!',

        ]);
        $helps = HelpTopic::find($id);
        $helps->question = $request->question;
        $helps->answer = $request->answer;
        $helps->ranking = $request->ranking;
        $helps->update();
        Toastr::success('FAQ Update successfully!');
        return back();
    }

    function list() {
        $helps = HelpTopic::latest()->get();
        return view('admin-views.help-topics.list', compact('helps'));
    }

    public function destroy(Request $request)
    {

        $helps = HelpTopic::find($request->id);
        $helps->delete();
        return response()->json();
    }

    // public function add_new_testimonial()
    // {
    //     return view('admin-views.help-topics.add-new-testimonial');
    // }

    public function store_testimonial(Request $request)
    {
        $data = $request->all();
        $request->validate([
            't_cust_name' => 'required',
            't_description'   => 'required',
        ], [
            't_cust_name.required' => 'Customer name is required!',
            't_description.required'   => 'Description is required!',

        ]);
        
        // print_r($request->file('image'));

        $helps = DB::table('testimonials')->insertGetId([
            't_cust_name' => $request->t_cust_name,
            't_cust_image'=> ImageManager::upload('banner/', 'png', $request->file('image')),
            't_description' => $request->t_description,
            't_status' => $request->status,
            't_rate' => $request->t_rate,
            't_review' => $request->t_review,
            't_created' => date('Y-m-d H:i:s'),
        ]);
        // // $get = DB::table('testimonials')->where('t_id',$helps)->first();
        // $imageName = ImageManager::update('banner/', $helps->t_cust_image, 'png', $request->file('image'));

        // // // $userDetails = [
        // // //     't_cust_image' => $imageName,
        // // // ];

        // DB::table('testimonials')->where('t_id',$helps)->update(array('t_cust_image' => $imageName));

        Toastr::success('Testimonial added successfully!');
        return back();
    }
    public function testimonial_status($id)
    {

        $helps = DB::table('testimonials')->where('t_id', $id)->first();
        if ($helps->status == 1) {
            $helps->update(["status" => 0]);

        } else {
            $helps->update(["status" => 1]);

        }
        return response()->json(['success' => 'Status Change']);

    }
    public function edit_testimonial($id)
    {
        // $helps = DB::table('testimonials')->findOrFail($id);
        $helps = DB::table('testimonials')->where('t_id', $id)->first();
        return response()->json($helps);
    }

    public function update_testimonial(Request $request, $id)
    {
        $request->validate([
            't_cust_name' => 'required',
            't_description'   => 'required',
        ], [
            't_cust_name.required' => 'Customer name is required!',
            't_description.required'   => 'Description is required!',

        ]);

        $helps = DB::table('testimonials')->where('t_id',$id)->update(array('t_cust_name'=>$request->t_cust_name,'t_description'=>$request->t_description,'t_rate'=>$request->t_rate,'t_review'=>$request->t_review));
        // $helps =DB::table('testimonials')->where('t_id',$id)->update(['t_cust_name'=>$request->t_cust_name,'t_description'=>$request->t_description,'t_rate'=>$request->t_rate,'t_review'=>$request->t_review]);
        // $helps = DB::table('testimonials')->find($id);
        // $helps->t_cust_name = $request->t_cust_name;
        // $helps->t_description = $request->t_description;
        // $helps->t_rate = $request->t_rate;
        // $helps->t_review = $request->t_review;
        // $helps->update();
        Toastr::success('Testimonial Update successfully!');
        return back();
    }

    function testimonial_list() {
        $helps = DB::table('testimonials')->get();
        return view('admin-views.help-topics.testimonial-list', compact('helps'));
    }

    public function destroy_testimonial(Request $request)
    {
        
        $helps = DB::table('testimonials')->where('t_id',$request['id']);
        $helps->delete();
        return response()->json();
    }

}

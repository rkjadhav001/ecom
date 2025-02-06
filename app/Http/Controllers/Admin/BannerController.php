<?php



namespace App\Http\Controllers\Admin;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Youtube;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\Seller_request;

class BannerController extends Controller
{

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $banners = Banner::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('banner_type', 'like', "%{$value}%");
                }
            })->orderBy('id', 'desc');
            $query_param = ['search' => $request['search']];
        } else {
            $banners = Banner::orderBy('id', 'desc');
        }
        $banners = $banners->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.banner.view', compact('banners', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'Title is required!',
            'image.required' => 'Image is required!',
        ]);

        $banner = new Banner;
        $banner->banner_type = $request->banner_type;
        $banner->category_id = '0';
        $banner->url = $request->title;
        $banner->photo = ImageManager::upload('banner/', 'png', $request->file('image'));
        $banner->save();
        Toastr::success('Banner added successfully!');
        return back();

    }



    public function status(Request $request)
    {

        if ($request->ajax()) {
            $banner = Banner::find($request->id);
            $banner->published = $request->status;
            $banner->save();
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function edit(Request $request)
    {
        $data = Banner::where('id', $request->id)->first();
        return response()->json($data);
    }



    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Title is required!',
        ]);
        $banner = Banner::find($request->id);
        $banner->category_id = '0';
        $banner->url = $request->title;
        if ($request->file('image')) {
            $banner->photo = ImageManager::update('banner/', $banner['photo'], 'png', $request->file('image'));
        }
        $banner->save();
        // return response()->json();
        Toastr::success('Banner updated successfully!');
        return back();
    }



    public function delete(Request $request)
    {

        $br = Banner::find($request->id);

        ImageManager::delete('/banner/' . $br['photo']);

        $br->delete();

        return response()->json();

    }



    public function Youtube(Request $request)
    {

        $query_param = [];

        $search = $request['search'];

        if ($request->has('search')) {

            $key = explode(' ', $request['search']);

            $banners = Youtube::where(function ($q) use ($key) {

                foreach ($key as $value) {

                    $q->Where('title', 'like', "%{$value}%");

                }

            })->orderBy('id', 'desc');

            $query_param = ['search' => $request['search']];

        } else {

            $banners = Youtube::orderBy('id', 'desc');

        }

        $banners = $banners->paginate(Helpers::pagination_limit())->appends($query_param);



        return view('admin-views.banner.Youtube', compact('banners', 'search'));

    }



    public function add_video(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'url' => 'required',

        ], [

            'title.required' => 'title is required!',

            'url.required' => 'url is required!',



        ]);



        $banner = new Youtube;

        $banner->title = $request->title;

        $banner->url = $request->url;

        $banner->save();

        Toastr::success('added successfully!');

        return back();

    }



    public function youtube_delete(Request $request)
    {

        $br = Youtube::find($request->id);

        $br->delete();

        return response()->json();

    }



    public function youtube_edit(Request $request)
    {

        $data = Youtube::where('id', $request->id)->first();

        return response()->json($data);

    }



    public function youtube_update(Request $request)
    {



        $banner = Youtube::find($request->id);

        $banner->title = $request->title;

        $banner->url = $request->url;

        $banner->save();



        Toastr::success('updated successfully!');

        return back();

    }





    function seller_request(Request $request)
    {

        $query_param = [];

        $search = $request['search'];

        if ($request->has('search')) {

            $key = explode(' ', $request['search']);

            $banners = Seller_request::with(['customer'])->where(function ($q) use ($key) {

                foreach ($key as $value) {

                    $q->Where('customer_name', 'like', "%{$value}%")->Where('phone', 'like', "%{$value}%");

                }

            })->orderBy('id', 'desc');

            $query_param = ['search' => $request['search']];

        } else {

            $banners = Seller_request::with(['customer'])->orderBy('id', 'desc');

        }

        $banners = $banners->paginate(Helpers::pagination_limit())->appends($query_param);



        return view('admin-views.banner.seller_request', compact('banners', 'search'));

    }



}


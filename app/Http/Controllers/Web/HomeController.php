<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $banners = Banner::where('published',1)->orderByDesc('id')->get();
        $categories = Category::where('home_status',1)->get();
        $categories->map(function ($data) {
            $data['products'] = Product::active()->whereJsonContains('category_ids', ["id" => (string)$data['id']])->inRandomOrder()->take(12)->get();

        });
        // return $categories;
        $featureProducts = Product::active()->where('featured_status',1)->inRandomOrder()->take(12)->get();
        $fourCategories = Category::where('home_status',1)->inRandomOrder()->take(3)->get();
        return view('web-views.home',compact('banners','categories','featureProducts','fourCategories'));
    }
}

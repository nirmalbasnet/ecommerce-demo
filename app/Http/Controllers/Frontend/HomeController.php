<?php

namespace App\Http\Controllers\Frontend;

use App\Model\ContactDetail;
use App\Model\HomeBanner;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\SocialMedaiLinks;
use App\Model\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $cats = ProductCategory::where('category_status', 'active')->orderBy('category_title', 'ASC')->get();
        $banners = HomeBanner::where('status', 'active')->orderBy('id', 'DESC')->get();
        $categories = ProductCategory::where('category_status', 'active')->inRandomOrder()->take(4)->get();
        $topProducts = Product::where('status', 'active')->where('is_top', 'yes')->inRandomOrder()->take('8')->get();
        $testimonies = Testimony::where('status', 'active')->get();
        return view('frontend.home', compact('cats', 'banners', 'categories', 'topProducts', 'testimonies'));
    }
}

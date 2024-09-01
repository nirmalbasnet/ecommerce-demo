<?php

namespace App\Http\Controllers\Frontend;

use App\Model\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('frontend.about', compact('aboutUs'));
    }
}

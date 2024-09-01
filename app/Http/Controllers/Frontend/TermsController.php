<?php

namespace App\Http\Controllers\Frontend;

use App\Model\AboutUs;
use App\Model\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function index()
    {
        $aboutUs = Policy::first();
        return view('frontend.terms', compact('aboutUs'));
    }
}

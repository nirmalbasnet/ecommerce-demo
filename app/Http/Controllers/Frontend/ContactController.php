<?php

namespace App\Http\Controllers\Frontend;

use App\Model\ContactDetail;
use App\Model\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if($request->method() == 'GET')
        {
            $contactDetail = ContactDetail::first();
            return view('frontend.contact', compact('contactDetail'));
        }else{
            $this->validate($request, [
               'name' => 'required',
               'email' => 'required|email',
               'message' => 'required'
            ]);

            Inquiry::create($request->except('_token'));
            return redirect()->back()->withMessage('Thank You ! Your feedback is much appreciated. We will get back to you as soon as possible.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Model\ContactDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactDetailController extends Controller
{
    public function index()
    {
        $contactDetail = ContactDetail::first();
        return view('admin.contact-detail.form', compact('contactDetail'));
    }


    public function submit(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $data = $request->except('_token');
        $contactDetail = ContactDetail::first();
        if($contactDetail == null){
            ContactDetail::create($data);
            return redirect('admin/contact-details')->withMessage('Contact Detail Successfully Created.');
        } else{
            $contactDetail->update($data);
            return redirect('admin/contact-details')->withMessage('Contact Detail Successfully Updated.');
        }
    }
}

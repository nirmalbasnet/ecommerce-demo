<?php

namespace App\Http\Controllers\Admin;

use App\Model\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function index()
    {
        if(Inquiry::where('status', 'unread')->count() > 0)
        {
            Inquiry::where('status', 'unread')->update([
               'status' => 'read'
            ]);
        }
        $inquiries = Inquiry::orderBy('id', 'DESC')->paginate('10');
        return view('admin.inquiry.inquiry', compact('inquiries'));
    }

    public function delete($id)
    {
        Inquiry::find($id)->delete();
        return 'true';
    }
}

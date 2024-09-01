<?php

namespace App\Http\Controllers\Admin;

use App\Model\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    public function index()
    {
        $data = Newsletter::orderBy('id', 'DESC')->paginate('10');
        return view('admin.newsletter.index', compact('data'));
    }

    public function status($id)
    {
        $subscriber = Newsletter::find($id);
        $newStatus = 'yes';
        if($subscriber->status == 'yes')
        {
            $newStatus = 'no';
        }

        $subscriber->update([
            'status' => $newStatus
        ]);

        return 'true';
    }

    public function delete($id)
    {
        Newsletter::find($id)->delete();
        return 'true';
    }
}

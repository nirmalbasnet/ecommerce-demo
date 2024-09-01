<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsLetterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters',
        ]);

        if ($validation->fails()) {
            $message = $validation->errors()->first();
            $return['status'] = 'validation-error';
            $return['message'] = $message;
            return $return;
        }

        $email = $request->email;
        if(Auth::check())
        {
            if(Auth::user()->status == 'active' && Auth::user()->email == $email)
            {
                Newsletter::create([
                    'email' => $email,
                    'verified' => 'yes'
                ]);
                $return['status'] = 'success';
                $return['message'] = 'You have successfully subscribed to our newsletter. We will keep you posted and updated.';
                return $return;
            }else{
                Newsletter::create([
                    'email' => $email,
                ]);

                $return['status'] = 'success';
                $return['message'] = 'true';
                return $return;
            }
        }else{
            Newsletter::create([
                'email' => $email,
            ]);
            $return['status'] = 'success';
            $return['message'] = 'true';
            return $return;
        }
    }

    public function verifySubscribe(Request $request)
    {
        $email = base64_decode($request->token);
        if(Newsletter::where('email', $email)->first() != null)
        {
            Newsletter::where('email', $email)->first()->update([
               'verified' => 'yes'
            ]);
        }

        return redirect('/')->with('alert-message', 'Your subscription has been verified. We will keep you posted and updated.');
    }
}

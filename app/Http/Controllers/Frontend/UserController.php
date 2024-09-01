<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ForgotPasswordEmail;
use App\Mail\RegistrationEmail;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function login()
    {
        return view('frontend.login');
    }

    public function loginValidation(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $check = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);

        if ($check) {
            if (Auth::user()->status == 'deactive') {
                Auth::logout();
                if (isset($request->return_url))
                    return redirect('login?return-url=' . $request->return_url)->with('error', 'You have been suspended  !')->withInput();
                else
                    return redirect('login')->with('error', 'You have been suspended ! Please contact kankai.com')->withInput();
            } else if (Auth::user()->status == 'inactive') {
                Auth::logout();
                if (isset($request->return_url))
                    return redirect('login?return-url=' . $request->return_url)->with('error', 'You have not activated your account yet ! Visit your email  !')->withInput();
                else
                    return redirect('login')->with('error', 'You have not activated your account yet ! Visit your email  !')->withInput();
            }else{
                return redirect('profile');
            }
        }else{
            return redirect('login')->with('error', 'Invalid Credential !')->withInput();
        }
    }

    public function signUp(Request $request)
    {
        if($request->method() == 'GET')
            return view('frontend.signup');
        else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'mobile' => 'required|unique:users|digits:10',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ]);

            $result = User::create($request->except(['_token', 'password_confirmation']));

            if($result)
            {
                Mail::to($request->email)->send(new RegistrationEmail($result));
            }

            return redirect()->back()->withMessage('Registration Successfull. Visit your email for account activation.');
        }
    }


    public function activation(Request $request)
    {
        $email = base64_decode($request->token);
        $user = User::where('email', $email)->first();
        $user->update([
           'status' => 'active'
        ]);
        Auth::login($user);
        return redirect('profile');
    }

    public function lostPassword(Request $request)
    {
        if($request->method() == 'GET')
            return view('frontend.lost');
        else{
            $this->validate($request, [
                'email' => 'required|email'
            ]);

            if(User::where('email', $request->email)->first() == null){
                return redirect()->back()->withMessage('The email provided does not match any record.')->withInput();
            }else{
                $user = User::where('email', $request->email)->first();
                Mail::to($request->email)->send(new ForgotPasswordEmail($user));
                return redirect()->back()->withMessage('Please visit your email for password reset.');
            }
        }
    }

    public function resetPassword(Request $request)
    {
        if($request->method() == 'GET')
        {
            $email = base64_decode($request->token);
            $user = User::where('email', $email)->first();
            return view('frontend.reset-password', compact('user'));
        }else{
            $this->validate($request, [
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);

            User::find($request->user_id)->update([
                'password' => $request->new_password
            ]);

            return redirect('profile');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\EmailChanged;
use App\Mail\RegistrationEmail;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|unique:users,mobile,' . $id . '|digits:10',
        ]);
        $logout = false;
        $dbUser = User::find($id);
        $updateData = $request->except('_token');
        if($dbUser->email != $request->email)
        {
            $logout = true;
            $updateData['status'] = 'inactive';
        }
        $dbUser->update($updateData);
        if($logout)
        {
            Mail::to($request->email)->send(new EmailChanged(User::find($id)));
            return redirect('login')->with('email-changed-message', 'Profile successfully updated. Visit your email for account activation.');
        }
        return redirect()->back()->withMessage('Profile successfully updated');
    }


    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        $dbUser = User::find($id);
        $checkCurrentPass = Hash::check($request->current_password, $dbUser->password);

        if(!$checkCurrentPass)
        {
            $errors = new MessageBag();
            $errors->add('current_password', 'Incorrect current password');
            return redirect()->back()->withErrors($errors)->withInput();
        }else{
            $dbUser->update(['password' => $request->new_password]);
            return redirect()->back()->withMessage('Password successfully changed');
        }
    }
}

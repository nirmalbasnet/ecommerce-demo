<?php

namespace App\Http\Controllers\Admin;

use App\Model\SocialMedaiLinks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaLinksController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedaiLinks::first();
        return view('admin.social-media-links.form', compact('socialMedia'));
    }


    public function submit(Request $request)
    {
        $this->validate($request, [
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
        ], [
            'facebook.url' => 'Please enter valid facebook link.',
            'twitter.url' => 'Please enter valid twitter link.',
            'instagram.url' => 'Please enter valid instagram link.',
        ]);

        $data = $request->except('_token');
        $socialMedia = SocialMedaiLinks::first();
        if($socialMedia == null){
            if($request->facebook == null && $request->twitter == null && $request->instagram == null)
                return redirect('admin/social-media-links')->withMessage('Social Media Link Successfully Created.');

            SocialMedaiLinks::create($data);
            return redirect('admin/social-media-links')->withMessage('Social Media Link Successfully Created.');
        } else{
            $socialMedia->update($data);
            return redirect('admin/social-media-links')->withMessage('Social Media Link Successfully Updated.');
        }
    }
}

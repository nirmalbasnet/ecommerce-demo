<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PolicyController extends Controller
{
    public function index()
    {
        $policy = Policy::first();
        return view('admin.policy.form', compact('policy'));
    }

    public function submit(Request $request)
    {
        $policy = Policy::first();
        if($policy == null)
        {
            $this->validate($request, [
                'image' => 'required|image|max:'.Constants::ABOUTUS_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::ABOUTUS_IMAGE__WIDTH.',min_height='.Constants::ABOUTUS_IMAGE__HEIGHT,
                'description' => 'required'
            ], [
                'image.required' => 'The policy banner is required.'
            ]);
        }else{
            $this->validate($request, [
                'image' => 'sometimes|required|image|max:'.Constants::ABOUTUS_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::ABOUTUS_IMAGE__WIDTH.',min_height='.Constants::ABOUTUS_IMAGE__HEIGHT,
                'description' => 'required'
            ], [
                'image.required' => 'The policy banner is required.'
            ]);
        }

        $data = $request->except('_token');
        if($request->hasFile('image'))
        {
            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $bannerPath = public_path().'/images/policy/';
            $thumbPath = public_path().'/images/policy/thumbs/';

            $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

            $thumbnailImage->resize(Constants::ABOUTUS_IMAGE__WIDTH, Constants::ABOUTUS_IMAGE__HEIGHT);
            $thumbnailImage->save($bannerPath.$filename);

            $thumbnailImage->resize(150,100);
            $thumbnailImage->save($thumbPath.$filename);

            if($policy != null)
            {
                if(file_exists(public_path('images/policy/'.$policy->image)))
                {
                    unlink(public_path('images/policy/'.$policy->image));
                }

                if(file_exists(public_path('images/policy/thumbs/'.$policy->image)))
                {
                    unlink(public_path('images/policy/thumbs/'.$policy->image));
                }
            }

            $data['image'] = $filename;
        }

        if($policy == null)
            Policy::create($data);
        else
            $policy->update($data);

        return redirect()->back()->withMessage('Task successfully completed');
    }
}

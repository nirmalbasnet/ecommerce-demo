<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('admin.about-us.form', compact('aboutUs'));
    }

    public function submit(Request $request)
    {
        $aboutUs = AboutUs::first();
        if($aboutUs == null)
        {
            $this->validate($request, [
                'image' => 'required|image|max:'.Constants::ABOUTUS_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::ABOUTUS_IMAGE__WIDTH.',min_height='.Constants::ABOUTUS_IMAGE__HEIGHT,
                'description' => 'required'
            ], [
                'image.required' => 'The about us banner is required.'
            ]);
        }else{
            $this->validate($request, [
                'image' => 'sometimes|required|image|max:'.Constants::ABOUTUS_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::ABOUTUS_IMAGE__WIDTH.',min_height='.Constants::ABOUTUS_IMAGE__HEIGHT,
                'description' => 'required'
            ], [
                'image.required' => 'The about us banner is required.'
            ]);
        }

        $data = $request->except('_token');
        if($request->hasFile('image'))
        {
            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $bannerPath = public_path().'/images/about-us/';
            $thumbPath = public_path().'/images/about-us/thumbs/';

            $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

            $thumbnailImage->resize(Constants::ABOUTUS_IMAGE__WIDTH, Constants::ABOUTUS_IMAGE__HEIGHT);
            $thumbnailImage->save($bannerPath.$filename);

            $thumbnailImage->resize(150,100);
            $thumbnailImage->save($thumbPath.$filename);

            if($aboutUs != null)
            {
                if(file_exists(public_path('images/about-us/'.$aboutUs->image)))
                {
                    unlink(public_path('images/about-us/'.$aboutUs->image));
                }

                if(file_exists(public_path('images/about-us/thumbs/'.$aboutUs->image)))
                {
                    unlink(public_path('images/about-us/thumbs/'.$aboutUs->image));
                }
            }

            $data['image'] = $filename;
        }

        if($aboutUs == null)
            AboutUs::create($data);
        else
            $aboutUs->update($data);

        return redirect()->back()->withMessage('Task successfully completed');
    }
}

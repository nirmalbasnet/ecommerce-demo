<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\HomeBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::orderBy('id', 'DESC')->paginate('10');
        return view('admin.home-banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.home-banner.form');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
           'banner' => 'required|image|max:'.Constants::HOME_BANNER_SIZE_IN_BIT.'|dimensions:min_width='.Constants::HOME_BANNER_WIDTH.',min_height='.Constants::HOME_BANNER_HEIGHT
        ]);

        $originalImage= $request->file('banner');
        $thumbnailImage = Image::make($originalImage);
        $bannerPath = public_path().'/images/home-banner/';
        $thumbPath = public_path().'/images/home-banner/thumbs/';

        $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

        $thumbnailImage->resize(Constants::HOME_BANNER_WIDTH, Constants::HOME_BANNER_HEIGHT);
        $thumbnailImage->save($bannerPath.$filename);

        $thumbnailImage->resize(150,100);
        $thumbnailImage->save($thumbPath.$filename);

        HomeBanner::create([
           'banner' => $filename
        ]);

        return redirect('admin/home-banner')->withMessage('Home Banner Successfully Created.');
    }

    public function status($id)
    {
        $banner = HomeBanner::find($id);
        $newStatus = 'active';
        if($banner->status == 'active')
        {
            $newStatus = 'inactive';
        }

        $banner->update([
           'status' => $newStatus
        ]);

        return 'true';
    }

    public function delete($id)
    {
        $banner = HomeBanner::find($id);

        if(file_exists(public_path('images/home-banner/'.$banner->banner)))
        {
            unlink(public_path('images/home-banner/'.$banner->banner));
        }

        if(file_exists(public_path('images/home-banner/thumbs/'.$banner->banner)))
        {
            unlink(public_path('images/home-banner/thumbs/'.$banner->banner));
        }

        $banner->delete();
        return 'true';
    }
}

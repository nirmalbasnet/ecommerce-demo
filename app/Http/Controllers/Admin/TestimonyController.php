<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::orderBy('id', 'DESC')->paginate('10');
        return view('admin.testimony.index', compact('testimonies'));
    }

    public function create()
    {
        return view('admin.testimony.form');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:200|max:250',
            'image' => 'required|image|max:'.Constants::TESTIMONY_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::TESTIMONY_IMAGE_WIDTH.',min_height='.Constants::TESTIMONY_IMAGE_HEIGHT,
        ]);

        $data = $request->except('_token');
        $originalImage= $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $bannerPath = public_path().'/images/testimony/';
        $thumbPath = public_path().'/images/testimony/thumbs/';

        $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

        $thumbnailImage->resize(Constants::TESTIMONY_IMAGE_WIDTH, Constants::TESTIMONY_IMAGE_HEIGHT);
        $thumbnailImage->save($bannerPath.$filename);

        $thumbnailImage->resize(100,100);
        $thumbnailImage->save($thumbPath.$filename);

        $data['image'] = $filename;
        Testimony::create($data);

        return redirect('admin/testimony')->withMessage('Testimony Successfully Created.');
    }

    public function edit($id)
    {
        $dataToEdit = Testimony::find($id);
        return view('admin.testimony.form', compact('dataToEdit'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:200|max:250',
            'image' => 'sometimes|required|image|max:'.Constants::TESTIMONY_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::TESTIMONY_IMAGE_WIDTH.',min_height='.Constants::TESTIMONY_IMAGE_HEIGHT,
        ]);

        $data = $request->except('_token');
        $oldData = Testimony::find($id);
        if($request->hasFile('image'))
        {
            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $bannerPath = public_path().'/images/testimony/';
            $thumbPath = public_path().'/images/testimony/thumbs/';

            $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

            $thumbnailImage->resize(Constants::TESTIMONY_IMAGE_WIDTH, Constants::TESTIMONY_IMAGE_HEIGHT);
            $thumbnailImage->save($bannerPath.$filename);

            $thumbnailImage->resize(100,100);
            $thumbnailImage->save($thumbPath.$filename);

            $data['image'] = $filename;


            if(file_exists(public_path('images/testimony/'.$oldData->image)))
            {
                unlink(public_path('images/testimony/'.$oldData->image));
            }

            if(file_exists(public_path('images/testimony/thumbs/'.$oldData->image)))
            {
                unlink(public_path('images/testimony/thumbs/'.$oldData->image));
            }
        }

        $oldData->update($data);

        return redirect('admin/testimony')->withMessage('Testimony Successfully Updated.');
    }

    public function status($id)
    {
        $t = Testimony::find($id);
        $newStatus = 'active';
        if($t->status == 'active')
        {
            $newStatus = 'inactive';
        }

        $t->update([
            'status' => $newStatus
        ]);

        return 'true';
    }

    public function delete($id)
    {
        $testimony = Testimony::find($id);

        if(file_exists(public_path('images/testimony/'.$testimony->image)))
        {
            unlink(public_path('images/testimony/'.$testimony->image));
        }

        if(file_exists(public_path('images/testimony/thumbs/'.$testimony->image)))
        {
            unlink(public_path('images/testimony/thumbs/'.$testimony->image));
        }

        $testimony->delete();
        return 'true';
    }
}

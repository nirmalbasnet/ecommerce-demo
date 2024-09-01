<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::orderBy('id', 'DESC')->paginate('10');
        return view('admin.product-category.index', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.product-category.form');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'category_title' => 'required|unique:product_categories',
            'category_image' => 'required|image|max:'.Constants::CATEGORY_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::CATEGORY_IMAGE_WIDTH.',min_height='.Constants::CATEGORY_IMAGE_HEIGHT
        ]);

        $originalImage= $request->file('category_image');
        $thumbnailImage = Image::make($originalImage);
        $bannerPath = public_path().'/images/product-category/';
        $thumbPath = public_path().'/images/product-category/thumbs/';

        $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

        $thumbnailImage->resize(Constants::CATEGORY_IMAGE_WIDTH, Constants::CATEGORY_IMAGE_HEIGHT);
        $thumbnailImage->save($bannerPath.$filename);

        $thumbnailImage->resize(100,120);
        $thumbnailImage->save($thumbPath.$filename);

        ProductCategory::create([
            'category_image' => $filename,
            'category_title' => $request->category_title,
            'slug' => str_slug($request->category_title)
        ]);

        return redirect('admin/product-category')->withMessage('Product Category Successfully Created.');
    }

    public function status($id)
    {
        $pc = ProductCategory::find($id);
        $newStatus = 'active';
        if($pc->category_status == 'active')
        {
            $newStatus = 'inactive';
        }

        $pc->update([
            'category_status' => $newStatus
        ]);

        return 'true';
    }

    public function delete($id)
    {
        $banner = ProductCategory::find($id);

        if($banner->product->count() > 0)
        {
            return 'restrict';
        }

        if(file_exists(public_path('images/product-category/'.$banner->category_image)))
        {
            unlink(public_path('images/product-category/'.$banner->category_image));
        }

        if(file_exists(public_path('images/product-category/thumbs/'.$banner->category_image)))
        {
            unlink(public_path('images/product-category/thumbs/'.$banner->category_image));
        }

        $banner->delete();
        return 'true';
    }

    public function edit($id)
    {
        $dataToEdit = ProductCategory::find($id);
        return view('admin.product-category.form', compact('dataToEdit'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'category_title' => 'required|unique:product_categories,category_title,'.$id,
            'category_image' => 'sometimes|required|image|max:'.Constants::CATEGORY_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::CATEGORY_IMAGE_WIDTH.',min_height='.Constants::CATEGORY_IMAGE_HEIGHT
        ]);

        $data = $request->except('_token');
        $oldData = ProductCategory::find($id);
        if($request->hasFile('category_image'))
        {
            $originalImage= $request->file('category_image');
            $thumbnailImage = Image::make($originalImage);
            $bannerPath = public_path().'/images/product-category/';
            $thumbPath = public_path().'/images/product-category/thumbs/';

            $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

            $thumbnailImage->resize(Constants::CATEGORY_IMAGE_WIDTH, Constants::CATEGORY_IMAGE_HEIGHT);
            $thumbnailImage->save($bannerPath.$filename);

            $thumbnailImage->resize(100,120);
            $thumbnailImage->save($thumbPath.$filename);
            $data['category_image'] = $filename;

            if(file_exists(public_path('images/product-category/'.$oldData->category_image)))
            {
                unlink(public_path('images/product-category/'.$oldData->category_image));
            }

            if(file_exists(public_path('images/product-category/thumbs/'.$oldData->category_image)))
            {
                unlink(public_path('images/product-category/thumbs/'.$oldData->category_image));
            }
        }


        $data['slug'] = str_slug($request->category_title);
        $oldData->update($data);

        return redirect('admin/product-category')->withMessage('Product Category Successfully Updated.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Model\Product;
use App\Model\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public $slugCounter = 0;

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate('10');
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('category_status', 'active')->orderBy('category_title', 'ASC')->get();
        return view('admin.product.form', compact('categories'));
    }

    public function createSlug($val, $sc = 0)
    {
        if($sc == 0)
        {
            $slug = str_slug($val);
        }else{
            $slug = str_slug($val).'-'.$sc;
        }

        if(Product::where('slug', $slug)->count() > 0)
        {
            $this->slugCounter++;
            return $this->createSlug($val, $this->slugCounter);
        }else{
            return $slug;
        }
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric|not_in:0',
            'image' => 'required|image|max:'.Constants::PRODUCT_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::PRODUCT_IMAGE_WIDTH.',min_height='.Constants::PRODUCT_IMAGE_HEIGHT,
            'has_offer' => 'required',
            'offer_price'  => 'required_if:has_offer,yes',
            'is_top' => 'required'
        ],[
            'name.required' => 'Product name is required.',
            'category_id.required' => 'Product category is required.',
            'price.required' => 'Product price is required.',
            'image.required' => 'Product image is required.',
            'has_offer.required' => 'Specify product has offer or not.',
            'is_top.required' => 'Specify product as top or not.',
        ]);

        if(isset($request->price) && $request->price != null && $request->price != '' && $request->has_offer == 'yes')
        {
            $this->validate($request, [
               'offer_price' => 'numeric'
            ]);
        }

        $data = $request->except('_token');
        $originalImage= $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $bannerPath = public_path().'/images/products/';
        $thumbPath = public_path().'/images/products/thumbs/';

        $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

        $thumbnailImage->resize(Constants::PRODUCT_IMAGE_WIDTH, Constants::PRODUCT_IMAGE_HEIGHT);
        $thumbnailImage->save($bannerPath.$filename);

        $thumbnailImage->resize(100,100);
        $thumbnailImage->save($thumbPath.$filename);

        $data['image'] = $filename;
        $data['slug'] = $this->createSlug($request->name);
        Product::create($data);

        return redirect('admin/product')->withMessage('Product Successfully Created.');
    }

    public function edit($id)
    {
        $categories = ProductCategory::where('category_status', 'active')->orderBy('category_title', 'ASC')->get();
        $dataToEdit = Product::find($id);
        return view('admin.product.form', compact('dataToEdit', 'categories'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric|not_in:0',
            'image' => 'sometimes|required|image|max:'.Constants::PRODUCT_IMAGE_SIZE_IN_BIT.'|dimensions:min_width='.Constants::PRODUCT_IMAGE_WIDTH.',min_height='.Constants::PRODUCT_IMAGE_HEIGHT,
            'has_offer' => 'required',
            'offer_price'  => 'required_if:has_offer,yes',
            'is_top' => 'required'
        ],[
            'name.required' => 'Product name is required.',
            'category_id.required' => 'Product category is required.',
            'price.required' => 'Product price is required.',
            'image.required' => 'Product image is required.',
            'has_offer.required' => 'Specify product has offer or not.',
            'is_top.required' => 'Specify product as top or not.',
        ]);

        if(isset($request->price) && $request->price != null && $request->price != '' && $request->has_offer == 'yes')
        {
            $this->validate($request, [
                'offer_price' => 'numeric'
            ]);
        }

        $data = $request->except('_token');
        $oldData = Product::find($id);
        if($request->hasFile('image'))
        {
            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $bannerPath = public_path().'/images/products/';
            $thumbPath = public_path().'/images/products/thumbs/';

            $filename = time().uniqid().'.'.$originalImage->getClientOriginalExtension();

            $thumbnailImage->resize(Constants::PRODUCT_IMAGE_WIDTH, Constants::PRODUCT_IMAGE_HEIGHT);
            $thumbnailImage->save($bannerPath.$filename);

            $thumbnailImage->resize(100,100);
            $thumbnailImage->save($thumbPath.$filename);

            $data['image'] = $filename;


            if(file_exists(public_path('images/products/'.$oldData->image)))
            {
                unlink(public_path('images/products/'.$oldData->image));
            }

            if(file_exists(public_path('images/products/thumbs/'.$oldData->image)))
            {
                unlink(public_path('images/products/thumbs/'.$oldData->image));
            }
        }

        if($oldData->name != $request->name)
            $data['slug'] = $this->createSlug($request->name);

        $oldData->update($data);

        return redirect('admin/product')->withMessage('Product Successfully Updated.');
    }

    public function status($id)
    {
        $p = Product::find($id);
        $newStatus = 'active';
        if($p->status == 'active')
        {
            $newStatus = 'inactive';
        }

        $p->update([
            'status' => $newStatus
        ]);

        return 'true';
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if(file_exists(public_path('images/products/'.$product->image)))
        {
            unlink(public_path('images/products/'.$product->image));
        }

        if(file_exists(public_path('images/products/thumbs/'.$product->image)))
        {
            unlink(public_path('images/products/thumbs/'.$product->image));
        }

        $product->delete();
        return 'true';
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\CreateAutoUser;
use App\Mail\Order;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function index($slug, Request $request)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        if(isset($request->{'order-by'}))
        {
            if($request->{'order-by'} == 'latest')
            {
                $products = $category->product()->where('status', 'active')->orderBy('id', 'DESC')->paginate('12');
            }elseif($request->{'order-by'} == 'price-low-to-high')
            {
                $products = $category->product()->where('status', 'active')->orderBy('price', 'ASC')->paginate('12');
            }elseif($request->{'order-by'} == 'price-high-to-low')
            {
                $products = $category->product()->where('status', 'active')->orderBy('price', 'DESC')->paginate('12');
            }else{
                $products = $category->product()->where('status', 'active')->orderBy('id', 'DESC')->paginate('12');
            }
        }elseif(isset($request->{'product'})){
            $products = $category->product()->where('status', 'active')->where('name', 'like', '%' . $_GET['product'] . '%')->orderBy('id', 'DESC')->paginate('12');
        }else{
            $products = $category->product()->where('status', 'active')->orderBy('id', 'DESC')->paginate('12');
        }
        return view('frontend.category-wise', compact('category', 'products'));
    }

    public function product($categorySlug, $productSlug, Request $request)
    {
        if ($request->method() == 'GET') {
            $category = ProductCategory::where('slug', $categorySlug)->first();
            $product = Product::where('slug', $productSlug)->first();
            $youMayAlsoLike = Product::where('status', 'active')->where('id', '<>', $product->id)->inRandomOrder()->take('10')->get();
            $latestProduct = Product::where('status', 'active')->where('id', '<>', $product->id)->orderBy('id', 'DESC')->take('4')->get();
            return view('frontend.product', compact('category', 'product', 'youMayAlsoLike', 'latestProduct'));
        } else {
            $data = $request->all();
            $data['category'] = ProductCategory::where('slug', $categorySlug)->first();
            $data['product'] = Product::where('slug', $productSlug)->first();
            \App\Model\Order::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'quantity' => $data['quantity'],
                'category_id' => $data['category']->id,
                'product_id' => $data['product']->id
            ]);
            Mail::to($data['email'])->send(new Order($data, 'user'));
            Mail::to('kankai.ecommerce@gmail.com')->send(new Order($data, 'admin'));
            if (User::where('email', $data['email'])->count() == 0 && User::where('mobile', $data['mobile'])->count() == 0) {
                $password = mt_rand(111111, 999999);
                $createdUser = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'registered_via' => 'web',
                    'status' => 'active',
                    'password' => $password
                ]);


                Mail::to($data['email'])->send(new CreateAutoUser($createdUser, $password));

                return redirect()->back()->with('message', 'Your order has been successfully placed. We will follow you back soon. Also the provided email have been automatically registered with kankai.com. Please visit the mail and get temporary password for login.');
            }

            return redirect()->back()->with('message', 'Your order has been successfully placed. We will follow you back soon.');
        }
    }

    public function autocomplete($categoryId)
    {
        $searchTerm = Input::get('query');
        $category = ProductCategory::find($categoryId);
        $queries = DB::table('products')
            ->where('category_id', $category->id)
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->take(10)->get();
        $results = [];
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }

        $uniqueArray = [];
        $uniqueArrayResult = [];
        $returnResult = [];
        if(count($results) > 0)
        {

            foreach ($results as $result)
            {
                if(!in_array($result['id'], $uniqueArray))
                {
                    $uniqueArray[] = $result['id'];
                    $uniqueArrayResult[] = ['id' => $result['id'], 'value' => $result['value']];
                }
            }
        }

        $returnResult['suggestions'] = $uniqueArrayResult;

        return response()->json($returnResult);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Rate;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request){

        $products = Product::with('product_images', 'rates', 'comments')
            ->when($request->search, function ($query, $search) {
            return $query->where('title','like','%'.$search.'%');
            })
            ->get();

        return Inertia::render('Product/Index',[
            'products'=>$products,
        ]);
    }


    public function create(){
        return Inertia::render('Admin/Product/Create');
    }

    public function store(Request $request){

        $product = new Product();
        $product->title = $request->title;
        $product->desc= $request->desc;
        $product->os= $request->os;
        $product->price= $request->price;
        $product->battery= $request->battery;
        $product->brand= $request->brand;
        $product->proximity= $request->proximity;
        $product->screen_size= $request->screen_size;
        $product->front_cam= $request->front_cam;
        $product->rear_cam= $request->rear_cam;
        $product->ram= $request->ram;
        $product->rear_cam_no= $request->rear_cam_no;
        $product->storage= $request->storage;
        $product->weight= $request->weight;
        $product->charger= $request->charger;
        $product->dimension= $request->dimension;
        $product->resolution= $request->resolution;
        $product->processor= $request->processor;
        $product->save();

        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');
            foreach ($productImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                // Store the image in the public folder with the unique name
                $image->move('images', $uniqueName);
                // Create a new product image record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'images/' . $uniqueName,
                ]);
            }
        }

            return redirect()->route('admin.products')->with('success','Product created.');

    }

    public function edit($id){
        $product = Product::query()->where('id','=',$id)->with('product_images')->first();
        return Inertia::render('Admin/Product/Edit',['product'=>$product]);
    }

    public function show($id){
        $product = Product::query()->where('id','=',$id)->with('product_images','rates')->first();
        return Inertia::render('Product/Show',['product'=>$product]);
    }


    public function compare(Request $request, $id){
        $product = Product::with('product_images')->where('id',$id)->first();
        $p = Product::with('product_images')->when($request->search, function($query, $search){
            return $query->where('title', 'like', '%'.$search.'%');
        })->first();

        return Inertia::render('Product/Compare',[
            'product'=>$product,
            'compared'=>$p
        ]);
    }


    public function update(Request $request, Product $product){

        $product->update($request->all());
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');

    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');

    }

    public function rate(Request $request, $id){
        $rate = Rate::find($id);
        if($rate)
            $rate->update($request->all());
        else
            Rate::create($request->all());

        return redirect()->back()->with('success','rated successfully.');
    }

    public function comment(Request $request){
        Comment::create($request->all());
        return redirect()->route('products.index')->with('success','comment added');
    }

    public function phone_finder(Request $request){
       $product = Product::when($request->search, function ($q, $search) {
        return $q->where(function ($query) use ($search) {
            $query->where('brand', 'like', '%' . $search['brand'] . '%')
                ->orWhere('os', 'like', '%' . $search['os'] . '%')
                ->where('charger', 'like', '%' . $search['charger'] . '%')
                ->where('storage', 'like', '%' . $search['storage'] . '%')
                ->where('processor', 'like', '%' . $search['processor'] . '%')
                ->where('battery', 'like', $search['battery'] . '%')
                ->where('ram', 'like', '%' . $search['ram'] . '%')
                ->where('rear_cam_no', '>=', $search['rear_cam_no'])
                ->where('screen_size', 'like', $search['screen_size'] . '%')
                ->where('created_at', 'like', $search['year'] . '%')
                ->whereBetween('price', [$search['price_start'], $search['price_end']]);
        });
    })->first();

    if(empty($product)){
        return Redirect::back()->with('error', 'no product found');
    } else {
        return redirect()->route('products.show', ['id'=>$product->id]);
    }

    }

    public function get_finder(){
        return Inertia::render('Product/PhoneFinder');
    }
}

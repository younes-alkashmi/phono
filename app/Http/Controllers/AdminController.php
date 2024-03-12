<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function products(){
        $products = Product::with('product_images')->get();
        return Inertia::render('Admin/Product/Index',[
            'products' => $products,
        ]);
    }


    public function news(){
        return Inertia::render('Admin/News/Index',[
            'news' => News::all()
        ]);
    }


    public function users(){
        return Inertia::render('Admin/User/Index',[
            'users'=>User::all()
        ]);
    }

    public function reviews(){
        return Inertia::render('Admin/Review/Index',[
            'reviews'=>Review::all()
        ]);
    }
}

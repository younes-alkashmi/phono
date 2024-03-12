<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Product $product){
        $user_comments= array();
        $product->comments()->pluck('user_name','content')->each(function($name,$content) use($user_comments){
             array_push($user_comments, [
                'user_name' => $name,
                'content' => $content
              ]) ;
            });

            return $product;
    }

    public function store(Request $request){
        Comment::create($request->all());
        return redirect()->back()->with('success','Comment Added');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index(){
        return Inertia::render('Review/Index',[
            'reviews'=>Review::all(),
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Review/Create');
    }

    public function store(Request $request){

        $review = new Review();
        $review->title = $request->title;
        $review->desc = $request->desc;
        $review->user_name = $request->user_name;
        $review->rate = $request->rate;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('images', $uniqueName);
            $review->image = 'images/' . $uniqueName;

        }

        $review->save();
        return redirect()->route('admin.reviews')->with('success','Review created.');

    }

    public function edit(Review $review){
        return Inertia::render('Admin/Review/Edit',['review'=>$review]);
    }

    public function show(Review $review){
        return Inertia::render('Review/Show',['review'=>$review]);
    }

    public function update(Request $request, Review $review){

        $review->update($request->all());
        return redirect()->route('admin.reviews')->with('success', 'Review updated successfully.');

    }

    public function destroy(Review $review){

        $review->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');

    }
}

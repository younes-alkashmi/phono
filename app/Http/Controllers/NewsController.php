<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(){
        return Inertia::render('News/Index',[
            'news'=>News::all(),
        ]);
    }

    public function create(){
        return Inertia::render('Admin/News/Create');
    }

    public function store(Request $request){

        $news = new News();
        $news->title = $request->title;
        $news->desc = $request->desc;
        $news->user_name = $request->user_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('images', $uniqueName);
            $news->image = 'images/' . $uniqueName;

        }

        $news->save();
        return redirect()->route('admin.news')->with('success','News created.');

    }

    public function edit(News $news){
        return Inertia::render('Admin/News/Edit',['news'=>$news]);
    }

    public function show(News $news){
        return Inertia::render('News/Show',['news'=>$news]);
    }

    public function update(Request $request, News $news){

        $news->update($request->all());
        return redirect()->route('admin.news')->with('success', 'news updated successfully.');

    }

    public function destroy(News $news){

        $news->delete();
        return redirect()->route('admin.news')->with('success', 'news deleted successfully.');

    }
}

<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    public function show($slug) {
       
        $category = Category::query()->where('slug', $slug)->first();
        $news = $category->news(5);        

        return view('categories.detail')
            ->with('news', $news)
            ->with('category', $category);
    }

}

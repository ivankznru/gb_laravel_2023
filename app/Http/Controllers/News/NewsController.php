<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->paginate(20);

        return view('news.index')->with('news', $news);
    }
    public function show(string $slug)
    {
        $newsItem = News::query()->where('slug', '=', $slug)->first();
        return view('news.detail')->with('newsItem', $newsItem);
    }
}

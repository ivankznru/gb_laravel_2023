<?php

declare(strict_types=1);

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table('news')->get();

        return view('news.index')
            ->with('news', $news);
    }
    public function show(string $slug)
    {
        $newsItem = DB::table('news')->where('slug', '=', $slug)->first();
        return view('news.detail')->with('newsItem', $newsItem);
    }
}

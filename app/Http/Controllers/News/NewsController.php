<?php

declare(strict_types=1);

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use App\Models\News;

class NewsController extends Controller
{
    public function listCategory($categorySlug, NewsCategories $newsCategories)
    {
        $category = $newsCategories->getBySlug($categorySlug);
        if ($category === null) {
            return view('notFound');
        }
        $news =  (new News())->listByCategorySlug($categorySlug);
        if ($news === null) {
            $news = [];
        }

        return view('news.categoryDetail')
            ->with('news', $news)->with('category', $category);
    }
    public function show(string $slug, News $news)
    {
        $newsItem = $news->getBySlug($slug);
        if ($newsItem === null) {
            return view('notFound');
        }

        return view('news.detail')->with('newsItem', $newsItem);
    }
}

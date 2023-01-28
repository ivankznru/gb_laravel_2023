<?php

declare(strict_types=1);

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use Illuminate\Support\Facades\DB;


class CategoriesController extends Controller
{
    public function index(NewsCategories $newsCategories)
    {
        $categories = DB::table('categories')->get();


        return view('news.categories')->with('categories', $categories);
    }
}

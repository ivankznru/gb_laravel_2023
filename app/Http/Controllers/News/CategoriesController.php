<?php

declare(strict_types=1);

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;

class CategoriesController extends Controller
{
    public function index()
    {

        $categories = (new NewsCategories)->getList();
        if ($categories === null) {
            return view('notFound');
        }
        return view('news.index')->with('categories', $categories);
    }
}

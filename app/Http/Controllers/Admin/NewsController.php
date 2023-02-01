<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\QueryBuilders\CategoriesQueryBuilder;
use App\QueryBuilders\NewsQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function index(NewsQueryBuilder $newsQueryBuilder): View
    {
        return \view('admin.news.index', [
            'news' => $newsQueryBuilder->getNewsWithPagination(),
        ]);
    }


   public function create(Request $request)
    {
        $news = new News();

        if ($request->isMethod('post')) {
           return $this->store($request, $news);
       }

       return view('admin.news.create', [
            'news' => $news,
           'categories' =>  Category::all(),
           'statuses' => NewsStatus::all()
        ]);
    }


    public function edit(News $news, CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return \view('admin.news.create', [
            'news' => $news,
            'categories' => $categoriesQueryBuilder->getAll(),
            'statuses' => NewsStatus::all(),
        ]);
    }

    public function store(Request $request, News $news)
    {
        $successMessage = 'The news item was successfully updated!';
        if ($news->id == null) {
            $successMessage = 'A news item was added successfully!';
        }
        $news->fill($request->all());
        $news->isPrivate = isset($request->isPrivate);
        $news->slug = Str::slug($news->title);
        $news->save();
        return redirect()->route('admin.news.index')->with('success', $successMessage);
    }


    public function update(Request $request, News $news)
    {
        return $this->store($request, $news);
    }

    public function delete(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'The news item was successfully deleted!');
    }

}

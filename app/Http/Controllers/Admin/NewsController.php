<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;


use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\News;
use App\QueryBuilders\CategoriesQueryBuilder;
use App\QueryBuilders\NewsQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class NewsController extends Controller
{

    public function index(NewsQueryBuilder $newsQueryBuilder): View
    {
        return \view('admin.news.index', [
            'news' => $newsQueryBuilder->getNewsWithPagination(),
        ]);
    }

    public function create()
    {
        $news = new News();
        return view('admin.news.create', [
            'news' => $news,
            'categories' =>  Category::all(),
            'statuses' => NewsStatus::all(),
        ]);
    }

    public function store(CreateRequest $request, News $news)
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

    public function edit(News $news, CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return \view('admin.news.create', [
            'news' => $news,
            'categories' => $categoriesQueryBuilder->getAll(),
            'statuses' => NewsStatus::all(),
        ]);
    }

    public function update(EditRequest $request, News $news)
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

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'The news item was successfully deleted!');
    }

}

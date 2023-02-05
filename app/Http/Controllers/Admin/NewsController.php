<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NewsStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Models\News;
use App\QueryBuilders\CategoriesQueryBuilder;
use App\QueryBuilders\NewsQueryBuilder;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    public function create(Request $request, News $news)
    {
      //  $news = new News();

        if ($request->isMethod('post')) {
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

        return view('admin.news.create', [
            'news' => $news,
            'categories' =>  Category::all(),
            'statuses' => NewsStatus::all(),
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

    public function store(CreateRequest $request, News $news)
    {
    //    $tableNameCategory = (new Category())->getTable();
    //    $this->validate($request, [
    //        'title' => 'required|min:3|max:20|unique:'.$tableNameCategory.',title',
    //        'text' => 'required|min:3',
    //        'author' => ['nullable', 'string', 'min:2', 'max:30'],
    //       'status' => ['required', new Enum(NewsStatus::class)],
    //        'image' => ['sometimes'],
    //        'isPrivate' => 'sometimes|in:1',
    //        'category_id' => "required|exists:{$tableNameCategory},id"
    //    ], [], [
    //        'title' => 'Title',
    //        'text' => 'Text',
    //        'category_id' => "News category"
     //   ]);

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


    public function update(EditRequest $request, News $news)
    {
     //   return $this->store($request, $news);
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

    public function delete(News $news)
    {
        try {
            $news->delete();

            return \response()->json('ok');
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), [$exception]);
            return \response()->json('error',400 );
        }
    }
}

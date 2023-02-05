<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateRequest;
use App\Http\Requests\Categories\EditRequest;
use App\QueryBuilders\CategoriesQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{


    public function index(CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return \view('admin.categories.index', [
            'categories' => $categoriesQueryBuilder->getCategoriesWithPagination(),
        ]);
    }

    public function create(Request $request)
    {
        $category = new Category();

        if ($request->isMethod('post')) {
            $successMessage = 'The category was successfully updated!';
            if ($category->id == null) {
                $successMessage = 'A category was added successfully!';
            }

            $category->fill($request->all());
            $category->slug = Str::slug($category->title);
            $category->save();
            return redirect()->route('admin.categories.index')->with('success', $successMessage);
        }

        return view('admin.categories.create', [
            'category' => $category,
        ]);
    }
    public function store(CreateRequest $request, Category $category)
    {

        $successMessage = 'The category was successfully updated!';
        if ($category->id == null) {
            $successMessage = 'A category was added successfully!';
        }

        $category->fill($request->all());
        $category->slug = Str::slug($category->title);
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', $successMessage);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create', [
            'category' => $category
        ]);
    }


    public function update(EditRequest $request, Category $category)
    {
        $successMessage = 'The category was successfully updated!';
        if ($category->id == null) {
            $successMessage = 'A category was added successfully!';
        }

        $category->fill($request->all());
        $category->slug = Str::slug($category->title);
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', $successMessage);
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();

            return \response()->json('ok');
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), [$exception]);
            return \response()->json('error',400 );
        }
    }
}

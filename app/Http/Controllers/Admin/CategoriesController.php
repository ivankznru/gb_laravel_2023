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
use Illuminate\Validation\Rule;


class CategoriesController extends Controller
{

    public function index(CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return \view('admin.categories.index', [
            'categories' => $categoriesQueryBuilder->getCategoriesWithPagination(),
        ]);
    }

    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', [
            'category' => $category,
        ]);
    }

    public function store(CreateRequest $request,Category $category)
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

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'The category was successfully deleted!');
    }

}

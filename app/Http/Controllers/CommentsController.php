<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\CreateRequest;
use App\Http\Requests\Comments\EditRequest;
use App\Models\Comments;
use App\QueryBuilders\CommentsQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    public function index(CommentsQueryBuilder $commentsQueryBuilder):View
    {
        return view('comments.index', [
            'comments' => $commentsQueryBuilder->getCommentsWithPagination(),
        ]);
    }

    public function create(Request $request,Comments $comments)
    {

        if ($request->isMethod('post')) {
            $successMessage = 'The comments was successfully updated!';
            if ($comments->id == null) {
                $successMessage = 'A comments was added successfully!';
            }

            $comments->fill($request->all());
            $comments->slug = Str::slug($comments->title);
            $comments->save();
            return redirect()->route('comments.index')->with('success', $successMessage);
        }

        return view('comments.create', [
            'comments' => $comments,
        ]);
    }

    public function store(CreateRequest $request, Comments $comments)
    {


        $successMessage = 'The comments was successfully updated!';
        if ($comments->id == null) {
            $successMessage = 'A comments was added successfully!';
        }

        $comments->fill($request->all());
        $comments->slug = Str::slug($comments->title);
        $comments->save();
        return redirect()->route('comments.index')->with('success', $successMessage);
    }

    public function edit(Comments $comments)
    {
        return view('comments.create', [
            'comments' => $comments
        ]);
    }

    public function update(EditRequest $request, Comments $comments)
    {
        $successMessage = 'The comments was successfully updated!';
        if ($comments->id == null) {
            $successMessage = 'A comments was added successfully!';
        }

        $comments->fill($request->all());
        $comments->slug = Str::slug($comments->title);
        $comments->save();
        return redirect()->route('comments.index')->with('success', $successMessage);
    }

    public function delete(Comments $comments)
    {
        $comments->delete();
        return redirect()->route('comments.index')->with('success', 'The category was successfully deleted!');
    }

}

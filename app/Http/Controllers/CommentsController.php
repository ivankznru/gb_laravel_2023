<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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


    public function create(Request $request)
    {
        $comments = new Comments();

        if ($request->isMethod('post')) {
            return $this->store($request, $comments);
        }

        return view('comments.create', [
            'comments' => $comments,
        ]);
    }

    public function store(Request $request, Comments $comments)
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

    public function update(Request $request, Comments $comments)
    {
        return $this->store($request, $comments);
    }

    public function delete(Comments $comments)
    {
        $comments->delete();
        return redirect()->route('comments.index')->with('success', 'The category was successfully deleted!');
    }

}

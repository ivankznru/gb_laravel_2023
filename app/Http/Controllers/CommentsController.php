<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CommentsController extends Controller
{
    function index() {
        return view('comments/index');
    }

    function store(Request $request) {

        try {
            // my data storage location is project_root/storage/app/comments.json file.
            $commentsInfo = Storage::disk('local')->exists('comments.json') ? json_decode(Storage::disk('local')->get('comments.json')) : [];

            $inputData = $request->only(['title', 'text']);

            $inputData['datetime_submitted'] = date('Y-m-d H:i:s');

            array_push($commentsInfo,$inputData);

            Storage::disk('local')->put('comments.json', json_encode($commentsInfo));

            return $inputData;

        } catch(Exception $e) {

            return ['error' => true, 'message' => $e->getMessage()];

        }
    }
}

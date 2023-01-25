<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestInfoController extends Controller
{
    function index() {
        return view('requestInfo/index');
    }

    function store(Request $request) {

        try {
            // my data storage location is project_root/storage/app/requests.json file.
            $requestInfo = Storage::disk('local')->exists('requests.json') ? json_decode(Storage::disk('local')->get('requests.json')) : [];

            $inputData = $request->only(['title', 'phoneNumber', 'email', 'text']);

            $inputData['datetime_submitted'] = date('Y-m-d H:i:s');

            array_push($requestInfo,$inputData);

            Storage::disk('local')->put('requests.json', json_encode($requestInfo));

            return $inputData;

        } catch(Exception $e) {

            return ['error' => true, 'message' => $e->getMessage()];

        }
    }
}

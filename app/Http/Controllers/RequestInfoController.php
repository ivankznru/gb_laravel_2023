<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RequestInfo\CreateRequest;
use App\Http\Requests\RequestInfo\EditRequest;
use App\Models\Request_info;
use App\QueryBuilders\RequestInfoQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestInfoController extends Controller
{
    public function index(RequestInfoQueryBuilder $requestInfoQueryBuilder):View
    {
        return view('requestInfo.index', [
            'requestInfo' => $requestInfoQueryBuilder->getRequestInfoWithPagination(),
        ]);
    }

    public function create(Request $request, Request_info $requestInfo)
    {

        if ($request->isMethod('post')) {
            $successMessage = 'The requestInfos was successfully updated!';
            if ($requestInfo->id == null) {
                $successMessage = 'A requestInfo was added successfully!';
            }
            $requestInfo->fill($request->all());
            $requestInfo->slug = Str::slug($requestInfo->title);
            $requestInfo->save();
            return redirect()->route('requestInfo.index')->with('success', $successMessage);
        }
        return view('requestInfo.create', [
            'requestInfo' => $requestInfo,
        ]);

    }

    public function edit(Request_info $requestInfo)
    {
        return view('requestInfo.create', [
            'requestInfo' => $requestInfo,
        ]);
    }

    public function store(CreateRequest $request, Request_info $requestInfo)
    {
        //TODO: check unique slug

        $successMessage = 'The requestInfos was successfully updated!';
        if ($requestInfo->id == null) {
            $successMessage = 'A requestInfo was added successfully!';
        }

        $requestInfo->fill($request->all());
        $requestInfo->slug = Str::slug($requestInfo->title);
        $requestInfo->save();
        return redirect()->route('requestInfo.index')->with('success', $successMessage);
    }

    public function update(EditRequest $request, Request_info $requestInfo)
    {
        $successMessage = 'The requestInfos was successfully updated!';
        if ($requestInfo->id == null) {
            $successMessage = 'A requestInfo was added successfully!';
        }

        $requestInfo->fill($request->all());
        $requestInfo->slug = Str::slug($requestInfo->title);
        $requestInfo->save();
        return redirect()->route('requestInfo.index')->with('success', $successMessage);
    }

    public function delete(Request_info $requestInfo)
    {
        $requestInfo->delete();
        return redirect()->route('requestInfo.index')->with('success', 'The requestInfo item was successfully deleted!');
    }


}

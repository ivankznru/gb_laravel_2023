<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ResourcesController extends Controller
{

    public function index()
    {
        $resources = Resource::query()->paginate(20);

        return view('admin.resources.index')->with('resources', $resources);
    }



    public function create()
    {
        $resource = new Resource();
        return view('admin.resources.create', [
            'resource' => $resource,
        ]);
    }

    public function store(Request $request)
    {
        $resource = new Resource();
        return $this->saveData($request, $resource);
    }

    public function edit(Resource $resource)
    {
        return view('admin.resources.create', [
            'resource' => $resource
        ]);
    }


    public function update(Request $request, Resource $resource)
    {

        return $this->saveData($request, $resource);
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index')->with('success', 'The resource was successfully deleted!');
    }

    /**
     * Saves data for create and update
     *
     * @return void
     */
    private function saveData(Request $request, Resource $resource){
        
        $tableNameResource = (new Resource())->getTable();
        $this->validate($request, [
            'url' => 
            [
                'required', 'min:3', 'max:200',
                Rule::unique($tableNameResource)->ignore($resource->id),
            ],
        ], [], [
            'url' => 'URL',
            'map' => 'News map',
            'resource_id' => "News resource"
        ]);

        $successMessage = 'The resource was successfully updated!';
        if ($resource->id == null) {
            $successMessage = 'A resource was added successfully!';
        }

        $resource->fill($request->all());
        $resource->save();
        return redirect()->route('admin.resources.index')->with('success', $successMessage);
    }
}

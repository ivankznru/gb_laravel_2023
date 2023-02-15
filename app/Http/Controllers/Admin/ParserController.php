<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Jobs\NewsParsing;

class ParserController extends Controller
{
    public function index()
    {
        $total=0;
        $sources = Resource::all();
        foreach ($sources as $srcDBData) {
            NewsParsing::dispatch($srcDBData->id);
            $total++;
            
        }
        return redirect()->route('categories.index')->with('success', 'Resources for parsing: ' . $total );
    }
}

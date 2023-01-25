<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function create(Request $request,  NewsCategories $newsCategories, News $newsList)
    {

        if ($request->isMethod('post')) {
            //TODO добавить новость в хранилище, прочитать старые новости, добавить новую в конце и сохранить обратно
            $data = $request->except("_token");
            $data["isPrivate"] = (array_key_exists("isPrivate", $data) && (intval($data["isPrivate"]) == 1));
            $data['slug'] = Str::slug($data['title']);
            $news = $newsList->getList();
            $news[] = $data;
            Storage::disk('local')->put('news.json', json_encode($news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            Storage::disk('local')->put('newsCategories.json', json_encode($newsCategories->getList(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            return redirect()->route('news.detail', $data['slug']);
        }
        return view('admin.news.create', [
            'categories' => $newsCategories->getList()
        ]);
    }

    public function download(Request $request,  NewsCategories $newsCategories, News $newsList)
    {

        if ($request->isMethod('post')) {
            $data = $request->except("_token");

            $news =  $newsList->listByCategoryId($data['categoryId']);
            if ($news === null) {
                $news = [];
            }
            return response()->json($news)
                ->header('Content-Disposition', 'attachment; filename = "news.json"')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        return view('admin.news.download', [
            'categories' => $newsCategories->getList()
        ]);
    }
}

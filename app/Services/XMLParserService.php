<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Str;

class XMLParserService
{
    public function saveNews($resourceId) {
        $srcDBData=Resource::query()->where('id', $resourceId)->first();
        $srcData = [
            "url" => "",
            "map" => [
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses' => 'channel.link'],
                'description' => ['uses' => 'channel.description'],
                'image' => ['uses' => 'channel.image.url'],
                'news' => ['uses' => ''],

            ]
        ];
            $srcData["url"] = $srcDBData["url"];
        $srcData["map"]["news"]["uses"] = $srcDBData["map"];
        $xml = XmlParser::load($srcData["url"]);
        $parsedNews = $xml->parse($srcData["map"]);
        $categorySlug = Str::slug($parsedNews["title"]);
        $category = Category::updateOrCreate([
            'slug' => $categorySlug,
        ], [
            'title' => $parsedNews["title"],
            'slug' => $categorySlug,
        ]);
        foreach ($parsedNews["news"] as $newsItem) {
            
            $news = News::updateOrCreate([
                'guid' => $newsItem["guid"],
            ], [
                'title' => $newsItem["title"],
                'slug' => Str::slug($newsItem["title"]),
                'text' =>  strlen(trim($newsItem["description"])) > 0 ? $newsItem["description"] : '',
                'category_id' => $category->id,
                'image' => strlen(trim($newsItem["image"])) > 0 ? $newsItem["image"] : '',
                'isPrivate' => (rand(0, 1) == 1),
            ]);
        }        
    }
}

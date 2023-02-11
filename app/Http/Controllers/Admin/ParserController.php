<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Str;

class ParserController extends Controller
{
    public function index()
    {

        $sources = [
            "un.org" => [
                "url" => "https://news.un.org/feed/subscribe/en/news/topic/health/feed/rss.xml",
                "map" => [
                    'title' => ['uses' => 'channel.title'],
                    'link' => ['uses' => 'channel.link'],
                    'description' => ['uses' => 'channel.description'],
                    'image' => ['uses' => 'channel.image.url'],
                    'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate,enclosure::url>image,category]'],
                ],
            ],
            "buzzfeed.com" => [
                "url" => "https://www.buzzfeed.com/animals.xml",
                "map" => [
                    'title' => ['uses' => 'channel.title'],
                    'link' => ['uses' => 'channel.link'],
                    'description' => ['uses' => 'channel.description'],
                    'image' => ['uses' => 'channel.image.url'],
                    'news' => ['uses' => 'channel.item[title,description,link,pubDate,guid,category,media,thumbnail::url>image,media:thumbnail::url]'],                    
                ],
            ],
            "thesun.co.uk" => [
                "url" => "https://www.thesun.co.uk/news/sport/feed/",
                "map" => [
                    'title' => ['uses' => 'channel.title'],
                    'link' => ['uses' => 'channel.link'],
                    'description' => ['uses' => 'channel.description'],
                    'image' => ['uses' => 'channel.image.url'],
                    'news' => ['uses' => 'channel.item[title,link,guid,content:encoded>description,pubDate,category,image]'],
                    
                ],
            ],
        ];
        $total = 0;
        foreach ($sources as $sourceName => $srcData) {
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
                $total++;
                $news = News::updateOrCreate([
                    'guid' => $newsItem["guid"],
                ], [
                    'title' => $newsItem["title"],
                    'slug' => Str::slug($newsItem["title"]),
                    'text' =>  strlen(trim($newsItem["description"])) > 0 ? $newsItem["description"] : '',
                    'category_id' => $category->id,
                    'image' => strlen(trim($newsItem["image"])) > 0 ? $newsItem["image"] : '',
                    'isPrivate'=> (rand(0,1)==1),
                ]);
            }
        }
        return redirect()->route('categories.index')->with('success', 'Parsed total: ' . $total . ' news');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecourcesSeeder extends Seeder
{
    private $data;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->initData();

        DB::table('resources')->insert($this->data);
    }

    private function initData()
    {
        $this->data = [
            [
                'url' => 'https://news.un.org/feed/subscribe/en/news/topic/health/feed/rss.xml',
                'map' => 'channel.item[title,link,guid,description,pubDate,enclosure::url>image,category]'
            ],
            [
                'url' => 'https://www.buzzfeed.com/animals.xml',
                'map' => 'channel.item[title,description,link,pubDate,guid,category,media,thumbnail::url>image,media:thumbnail::url]'
            ],
            [
                'url' => 'https://www.thesun.co.uk/news/sport/feed/',
                'map' => 'channel.item[title,link,guid,content:encoded>description,pubDate,category,image]'
            ],

        ];
    }
}

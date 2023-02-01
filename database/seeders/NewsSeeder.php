<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker;
use App\Models\Category;


class NewsSeeder extends Seeder
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
        $this->makeSlugs();
        DB::table('news')->insert($this->data);
    }

    private function initData()
    {
        $categories = Category::all();
        $categoriesCount = count($categories);

        $this->data = [];
        $faker = Faker\Factory::create('en_GB');
        for ($i = 0; $i < 25; $i++) {
            $newsCategory = $categories[rand(0, $categoriesCount - 1)];
            $this->data[] = [
                'title' => "About " . $newsCategory->title . ": " . $faker->realText(rand(10, 30)),
                'text' => "This is an article about " . $newsCategory->title . ". " . $faker->realText(rand(1000, 3000)),
                'category_id' => $newsCategory->id,
                'isPrivate' => false,
                'author' => $newsCategory->author . " " . $faker->name(),
            ];
        }
    }

    private function makeSlugs()
    {
        foreach ($this->data as $idx => $item) {
            $this->data[$idx]['slug'] = Str::slug($item['title']);
        }
    }
}

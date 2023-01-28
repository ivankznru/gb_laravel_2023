<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker;


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
        $this->data = [];
        $faker = Faker\Factory::create('en_GB');
        for ($i = 0; $i < 25; $i++) {
            $this->data[] = [
                'title' => $faker->realText(rand(10, 30)),
                'text' => $faker->realText(rand(1000, 3000)),
                'isPrivate' => false
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

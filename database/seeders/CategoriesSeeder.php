<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
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

        DB::table('categories')->insert($this->data);
    }
    
    private function initData()
    {
        $this->data = [
            ['title' => 'World News'],
            ['title' => 'Hi-Tech news'],
            ['title' => 'Sport'],
            ['title' => 'Travel'],
            ['title' => 'Health'],
        ];
    }
    
    private function makeSlugs()
    {
        foreach ($this->data as $idx => $item) {
            $this->data[$idx]['slug'] = Str::slug($item['title']);
        }
    }
}

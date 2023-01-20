<?php

namespace App\Models;

use Illuminate\Support\Str;

class NewsCategories extends StaticArrayDataProvider
{
    protected $data = [
        ['id' => '1', 'title' => 'World News',],
        ['id' => '2', 'title' => 'Hi-Tech news',],
        ['id' => '3', 'title' => 'Sport',],
        ['id' => '4', 'title' => 'Travel',],
        ['id' => '5', 'title' => 'Health',],
        ['id' => '6', 'title' => 'A New and Empty Category',],

    ];    
    public function __construct()
    {        
        $this->setSlug();
        
    }
}

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

    ];    
    public function __construct()
    {        
        $this->setSlug();
        
    }
}

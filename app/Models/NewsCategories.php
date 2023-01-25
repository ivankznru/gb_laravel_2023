<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsCategories extends StaticArrayDataProvider
{
    protected $data = [];    
    public function __construct()
    {        
        $this->data = json_decode(Storage::disk('local')->get('newsCategories.json'), true);
        if (empty($this->data)){
            $this->data=[];
        }
        $this->setSlug();
        
    }
}

<?php

namespace App\Models;

use App\Models\NewsCategories;
use Illuminate\Support\Facades\Storage;

class News extends StaticArrayDataProvider
{
    protected $data = [];
    public function __construct()
    {        
        $this->data = json_decode(Storage::disk('local')->get('news.json'), true);
        if (empty($this->data)){
            $this->data=[];
        }
        $this->setSlug();
    }

    /**
     * Gets list of items by slug
     *
     * @param string $slug an item a slug
     * @return array an item
     */
    public function listByCategoryId(string $categoryId): ?array
    {
        $list = [];
        foreach ($this->data as $item) {
            if ($item["categoryId"] == $categoryId) {
                $list[] = $item;
            }
        }
        if (count($list) == 0) {
            return null;
        }
        return $list;
    }
    /**
     * Gets list of items by category slug
     *
     * @param string $slug a category slug
     * @return array a list of items
     */
    public function listByCategorySlug(string $categorySlug): ?array
    {
        $newsCategories = new NewsCategories();
        $category = $newsCategories->getBySlug($categorySlug);
        if ($category == null) {
            return null;
        }
        return static::listByCategoryId($category['id']);
    }
}

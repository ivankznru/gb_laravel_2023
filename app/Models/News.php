<?php

namespace App\Models;


use App\Models\NewsCategories;


class News extends StaticArrayDataProvider
{
    protected $data = [
        ['id' => '1', 'categoryId' => '1', 'title' => 'Something about World News #1 ', 'text' => 'Here is a text #1 about World News...',],
        ['id' => '2', 'categoryId' => '1', 'title' => 'Something about World News #2 ', 'text' => 'Here is a text #2 about World News...',],
        ['id' => '3', 'categoryId' => '1', 'title' => 'Something about World News #3 ', 'text' => 'Here is a text #3 about World News...',],
        ['id' => '4', 'categoryId' => '1', 'title' => 'Something about World News #4 ', 'text' => 'Here is a text #4 about World News...',],
        ['id' => '5', 'categoryId' => '2', 'title' => 'Something about Hi-Tech news #5 ', 'text' => 'Here is a text #5 about Hi-Tech news...',],
        ['id' => '6', 'categoryId' => '2', 'title' => 'Something about Hi-Tech news #6 ', 'text' => 'Here is a text #6 about Hi-Tech news...',],
        ['id' => '7', 'categoryId' => '2', 'title' => 'Something about Hi-Tech news #7 ', 'text' => 'Here is a text #7 about Hi-Tech news...',],
        ['id' => '8', 'categoryId' => '2', 'title' => 'Something about Hi-Tech news #8 ', 'text' => 'Here is a text #8 about Hi-Tech news...',],
        ['id' => '9', 'categoryId' => '3', 'title' => 'Something about Sport #9 ', 'text' => 'Here is a text #9 about Sport...',],
        ['id' => '10', 'categoryId' => '3', 'title' => 'Something about Sport #10 ', 'text' => 'Here is a text #10 about Sport...',],
        ['id' => '11', 'categoryId' => '3', 'title' => 'Something about Sport #11 ', 'text' => 'Here is a text #11 about Sport...',],
        ['id' => '12', 'categoryId' => '3', 'title' => 'Something about Sport #12 ', 'text' => 'Here is a text #12 about Sport...',],
        ['id' => '13', 'categoryId' => '4', 'title' => 'Something about Travel #13 ', 'text' => 'Here is a text #13 about Travel...',],
        ['id' => '14', 'categoryId' => '4', 'title' => 'Something about Travel #14 ', 'text' => 'Here is a text #14 about Travel...',],
        ['id' => '15', 'categoryId' => '4', 'title' => 'Something about Travel #15 ', 'text' => 'Here is a text #15 about Travel...',],
        ['id' => '16', 'categoryId' => '4', 'title' => 'Something about Travel #16 ', 'text' => 'Here is a text #16 about Travel...',],
        ['id' => '17', 'categoryId' => '5', 'title' => 'Something about Health #17 ', 'text' => 'Here is a text #17 about Health...',],
        ['id' => '18', 'categoryId' => '5', 'title' => 'Something about Health #18 ', 'text' => 'Here is a text #18 about Health...',],
        ['id' => '19', 'categoryId' => '5', 'title' => 'Something about Health #19 ', 'text' => 'Here is a text #19 about Health...',],
        ['id' => '20', 'categoryId' => '5', 'title' => 'Something about Health #20 ', 'text' => 'Here is a text #20 about Health...',],
    ];
    public function __construct()
    {
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

<?php

namespace App\Models;

use Illuminate\Support\Str;

/**
 * Array data provider from static data
 */
class StaticArrayDataProvider implements IArrayDataProvider
{
    protected $data = [];

    public function setSlug(){
        
        foreach ($this->data as $idx => $item) {
            $this->data[$idx]['slug'] = Str::slug($item['title']);
        }

    }
    /**
     * Gets a list of items
     *
     * @return array items
     */
    public function getList(): array
    {
        return $this->data;
    }

    /**
     * Gets an item by an ID
     *
     * @param integer $id an item ID
     * @return array an item
     */
    public function getById(int $id): ?array
    {
        foreach ($this->data as $item) {
            if ($item["id"] == $id) {
                return $item;
            }
        }
        //Find nothing
        return null;
    }

    /**
     * Gets an item by slug
     *
     * @param string $slug an item a slug
     * @return array an item
     */
    public function getBySlug(string $slug): ?array
    {
        foreach ($this->data as $item) {
            if ($item["slug"] == $slug) {
                return $item;
            }
        }
        //Find nothing
        return null;
    }
}

<?php

namespace App\Models;

/**
 * Interface for getting a data as arrays
 */
interface IArrayDataProvider
{
    /**
     * Gets a list of items
     *
     * @return array items
     */
    public function getList(): array;

    /**
     * Gets an item by an ID
     *
     * @param integer $id an item ID
     * @return array an item
     */
    public function getById(int $id): ?array;

    /**
     * Gets an item by slug
     *
     * @param string $slug an item a slug
     * @return array an item
     */
    public function getBySlug(string $slug): ?array;
}

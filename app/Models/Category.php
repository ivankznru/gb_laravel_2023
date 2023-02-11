<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug'];
    /**
     * Get news of a category
     *
     * @param int $pageSize Items per page     
     */
    public function news($pageSize) {
        return $this->hasMany(News::class, 'category_id')->paginate($pageSize);
    }

}

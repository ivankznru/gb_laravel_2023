<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'text', 'isPrivate', 'category_id', 'author','status','image'];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id')->first();
    }
}

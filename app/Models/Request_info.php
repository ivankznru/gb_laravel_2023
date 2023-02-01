<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_info extends Model
{
    use HasFactory;
    protected $fillable = [  'title', 'phoneNumber', 'slug','email', 'text'];
}

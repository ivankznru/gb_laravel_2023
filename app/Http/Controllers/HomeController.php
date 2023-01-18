<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function auth()
    {
        return view('auth');
    }
    public function addNewsItem()
    {
        return view('addNewsItem');
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return
        "<H1>Lesson #1</H1>
        <ul>
            <li><a href='/profile/'>Profile</a></li>
            <li><a href='/about/'>About us</a></li>
            <li><a href='/news/'>News</a></li>
        </ul>";
});

Route::get('/about/', function () {
    return "
    <H1>About us</H1>
    Coming soon...";
});


Route::get('/profile/', function () {

    $userName = "<Unregistered \"User\">";
    return "<H1>Profile</H1>
    Greetings, " . htmlspecialchars($userName) . "!";
});

Route::get('/news', function () {
    return
        "<H1>Our news</H1>
        <ul>
            <li><a href='/news/1'>News #1</a></li>
            <li><a href='/news/11'>News #11</a></li>
            <li><a href='/news/123'>News #123</a></li>
        </ul>";
});

Route::get('/news/{newsElement}', function (string $newsElement) {
    $newsElementId = intval($newsElement);
    if ($newsElementId <= 0) {
        return "<i>Not found</i>";
    }

    return "
    <H1>News #" . $newsElementId . "</H1>
    Some texts about news #" . $newsElementId . "...";
});



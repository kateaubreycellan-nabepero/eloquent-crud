<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/{id}/{title}/{body}', function($id, $title, $body) {

    $user = User::findOrFail($id);
    $post = new Post(['title'=>$title, 'body'=>$body]);
    $result = $user->posts()->save($post);
    return $result ? true : false;

});
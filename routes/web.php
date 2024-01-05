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

Route::get('/read/{id}', function($id) {

    $user = User::findOrFail($id);

    return $user->posts;

    // foreach ($user->posts as $post) {
    //     echo 'Post title: '.$post->title.'<br>Post content: '.$post->body.'<br>-------------<br>';
    // }

});

Route::get('/update/{id}/{post_id}/{title}/{body}', function($id, $post_id, $title, $body) {

    $user = User::findOrFail($id);
    $result = $user->posts()->where('id', $post_id)->update(['title'=>$title, 'body'=>$body]);
    return $result ? true : false;

});
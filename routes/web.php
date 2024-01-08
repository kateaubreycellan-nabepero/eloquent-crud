<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\Video;

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

Route::get('/create/{tag_id1}/{tag_id2}/{post_title}/{video_title}', function($tag_id1, $tag_id2, $post_title, $video_title) {

    $post = Post::create(['name'=>$post_title]);
    $tag = Tag::findOrFail($tag_id1);
    $result1 = $post->tags()->save($tag);
    // echo "1st: $result1<br>";

    $video = Video::create(['name'=>$video_title]);
    $tag2 = Tag::findOrFail($tag_id2);
    $result2 = $video->tags()->save($tag2);
    // echo "2nd: $result2<br>";

    return "$result1 | $result2";

});

Route::get('/read/{post_id}', function($post_id) {

    $post = Post::findOrFail($post_id);

    foreach ($post->tags as $tag)
    {
        echo $tag;
    }

});

Route::get('/update/{post_id}', function($post_id) {

    $post = Post::findOrFail($post_id);

    // foreach ($post->tags as $tag)
    // {
    //     $result = $tag->where('name', '=', 'PHP')->update(['name'=>'Updated PHP']);
    // }

    // return $result;

    $tag = Tag::findOrFail(3);

    // Alternative methods
    $post->tags()->save($tag);
    // $post->tags()->attach($tag);
    // $post->tags()->sync([1,3]);

});
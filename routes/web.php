<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function(){
    $category = App\Models\Category::find(3);
    return $category->posts;

    $comment = App\Models\Comment::find(15);
    //return $comment->author;
    //return $comment->post;

    $post = App\Models\Post::find(15);
    //return $post->category;
    //return $post->author;
    //return $post->comments;
    //return $post->tags;

    $tag = App\Models\Tag::find(5);
    //return $tag->posts;

    $author = App\Models\User::find(8);
    //return $author->posts;
    //return $author->comments;

});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
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
    return view('welcome');
});


/**
 * 
 *  One To Many
 */

 Route::get('/create_user',function(){
     $user = User::create([
         'name' => 'Fikri',
         'email' => 'fikri@gmail.com',
         'password' => bcrypt('password')
     ]);
     return $user;

 });

 Route::get('/create_user_posts',function(){
     $user = User::findOrFail(2);

     $user->posts()->create([
         'title' => 'Second Post by Hafid',
         'body' => 'HEHEHHEHEHAHAHHA'
     ]);

     return $user;
 });

 Route::get('/read_user_posts',function(){
     $user = User::findOrFail(2);

     $posts = $user->posts()->get();

     foreach($posts as $post){
         $data[] = [
             'user_id' => $post->user_id,
             'name' => $post->user->name,
             'email' => $post->user->email,
             'id' => $post->id,
             'title' => $post->title,
             'body' => $post->body,
         ];
     }

     return $data;

 });

 Route::get('update_user_posts',function(){
     $user = User::findOrFail(1);

     $user->posts()->where('id',1)->update([
         'title' => 'Fall in love in january',
         'body' => 'by the way it\'s aprial moops'
     ]);

      $posts = $user->posts()->get();

     foreach($posts as $post){
         $data[] = [
             'user_id' => $post->user_id,
             'name' => $post->user->name,
             'email' => $post->user->email,
             'id' => $post->id,
             'title' => $post->title,
             'body' => $post->body,
         ];
     }

     return $data;

 });

 Route::get('delete_user_posts',function(){
     $user = User::findOrFail(2);

     $user->posts()->where('id',3)->delete();

      $posts = $user->posts()->get();

     foreach($posts as $post){
         $data[] = [
             'user_id' => $post->user_id,
             'name' => $post->user->name,
             'email' => $post->user->email,
             'id' => $post->id,
             'title' => $post->title,
             'body' => $post->body,
         ];
     }

     return $data;

 });
<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Str;
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
 *  One to One Relationships
 *    
 */

Route::get('/create_user_profile',function(){
    $user = User::find(2);

    $profile = $user->profile()->create([
        'phone' => '123',
        'address' => 'Jambi'
    ]);

    return $profile;
});

Route::get('/read_user_profile_byUser',function(){
    $user = User::findOrFail(1);

    $data = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->profile->phone,
        'address' => $user->profile->address,
    ];

    return $data;

});

Route::get('/read_user_profile_byProfile',function(){
    $profile = Profile::findOrFail(1);

    $data = [
        'id' => $profile->user->id,
        'name' => $profile->user->name,
        'email' => $profile->user->email,
        'phone' => $profile->phone,
        'address' => $profile->address
    ];

    return $data;


});

Route::get('/update_user_profile', function(){
    $user = User::find(1);

    $user->profile()->update([
        'phone' => '234',
        'address' => 'Padang'
    ]);

    return $user->profile;

});

Route::get('/delete_user_profile',function(){
    $user = User::findOrFail(1);

    $user->profile()->delete();
    
    return 'deleted success';

});

/**
 * 
 * One to Many Relationships
 * 
 */

Route::get('/create_user_posts',function(){
    $user = User::findOrFail(5);

    $user->posts()->create([
        'title' => 'Makanan',
        'body' => 'Biasa aja sih.'
    ]);

    return $user->posts;

});

Route::get('/update_user_posts',function(){
    $user = User::findOrFail(1);

    $user->posts()->update([
        'title' => 'Me',
        'body' => 'wht happen?'
    ]);

    return $user->posts;

});

Route::get('/delete_user_posts',function(){
    $user = User::findOrFail(1);

    $user->posts()->delete();

    return 'deleted success';
});


/**
 * 
 * Many to Many Relationships
 * 
 */

 Route::get('/create_category_post',function(){
     $post = Post::findOrFail(5);

     $post->categories()->create([
         'category' => 'Soccerr'
     ]);

     return $post->categories;
 });

 Route::get('/attach_category_post',function(){
     $post = Post::findOrFail(4);

     $post->categories()->attach([1,2,3]);

     return $post->categories;

 });

  Route::get('/detach_category_post',function(){
     $post = Post::findOrFail(6);

     $post->categories()->detach([1,2]);

     return 'deleted cuccess';

 });

 Route::get('/sync_category_post',function(){
     $post = Post::findOrFail(6);

     $post->categories()->sync([1]);

     return 'sync cuccess';

 });


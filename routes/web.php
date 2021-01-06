<?php

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

Route::get('/create_user',function(){
    $user = User::create([
        'name' => 'Hafid Dwi Adha',
        'email' => 'hafiddwiadha@gmail.com',
        'password' => bcrypt('password')
    ]);
    return $user;
});

Route::get('/create_user_profile',function(){
    $user = User::find(1);
    $data = [
        'phone' => '0877xxxxxxx1',
        'address' => 'Padang'
    ];

    // Cara -1
    $user->profile()->create($data);

    // Cara -2
    // $profile = new Profile($data);
    // $user->profile()->save($profile);
    return $user;
});

Route::get('/read_user_profile',function(){
    $user = User::find(1);

    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->profile->phone,
        'address' => $user->profile->address
    ];

    return $data;

});


Route::get('/update_user_profile',function(){
    $user = User::find(1);
    $user->profile->update([
        'phone' => '12345',
        'address' => 'Jambi'
    ]);

    return $user;
});

Route::get('/delete_user_profile',function(){
    $user = User::find(1);
    $user->profile->delete();
    return 'success';
});

Route::get('create_user_posts',function(){
    $user = User::find(1);

    $user->posts()->create([
        'title' => 'Last Post',
        'body' => 'lorem lorem'
    ]);

    return $user;
});

Route::get('/read_user_posts',function(){
    $user = User::find(1);

    $posts = $user->posts()->get();

    foreach($posts as $post){
        $data [] = [
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

Route::get('/update_user_post',function(){
    $user = User::findOrFail(1);

    $user->posts()->where('id',2)->update([
                    'title' => 'Hehe First',
                    'body' => 'Hello',
                ]);

   $posts = $user->posts()->get();

    foreach($posts as $post){
        $data [] = [
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

Route::get('/delete_user_posts',function(){
    $user = User::findOrFail(1);

    $user->posts()->where('id',1)->delete();

    $posts = $user->posts()->get();

    foreach($posts as $post){
        $data[] = [
            'user_id' => $post->user_id,
            'name' => $post->user->name,
            'email' => $post->user->emai,
            'title' => $post->title,
            'body' => $post->body,
        ];
    }

    return $data;

});
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsletterController;

use App\Models\User;
use App\Models\Post;




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

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect('/home');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);

// Auth::routes(['verify' => true]);
// Create posts
Route::get('insert-posts', function(){
    $user = User::findorfail(1);
    $posts = Post::create(['title'=>"first blog", 'body'=>"djcnkejjdwjehsbdhnsdchsdncshdjdshcb"]);
    $user->posts()->save($posts);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index']);
Route::get('/index2', [HomeController::class, 'index2']);
Route::get('/users', [HomeController::class, 'users']);


// CRUD Application for blog post
// create post
/* Route::get('/create', function($id){
    $user = User::findorfail($id);
    $post = Post::create();
    $user->posts()->save($posts);
    return "post has been successfully created";
}); */

// read post
Route::get('/posts', function($id){
    $posts = User::findorfail($id)->post;
    foreach ($posts as $post){
        echo $post;
        echo '<br />';
    }  

});

//Update post
Route::get('/update', function($id){
 $posts= User::findorfail($id)->posts()->update();
});

// Delete post
Route::get('/delete', function($id){
User::findorfail($id)->posts()->delete(); 
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{id}', 'show');
    Route::post('/posts', 'store');
});

// Post Controller
Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
// ->with('posts', Post::all());
Route::get('post/create', [App\Http\Controllers\PostController::class, 'create']);
Route::post('posts', [App\Http\Controllers\PostController::class, 'store']);
Route::get('posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit']);
Route::get('posts/{post}', [App\Http\Controllers\PostController::class, 'show']);
Route::put('posts/{post}', [App\Http\Controllers\PostController::class, 'update']);
Route::delete('posts/{post}', [App\Http\Controllers\PostController::class, 'destroy']);

// Newsletter Controller
Route::post('subscribe', [App\Http\Controllers\NewsletterController::class, 'store']);
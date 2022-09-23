<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogPostController;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Models\User;
use App\Models\BlogPost;


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
    return view('dashboard');
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
    $posts = BlogPost::create(['title'=>"dgdhchegd", 'body'=>"djcnkejjdwjehsbdhnsdchsdncshdjdshcb"]);
    $user->posts()->save($posts);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogPostController::class, 'index']);

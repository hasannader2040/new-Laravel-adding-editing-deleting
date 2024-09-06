<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Facade\Ignition\DumpRecorder\Dump;

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



require __DIR__ . '/auth.php';


Route::get('/', function () {
    dd("Hello");
    if (auth()->check()) {
        // $posts = auth()->user()->usersCoolPosts()->latest()->get();
    } else {
        $posts = []; // Return empty posts if no user is authenticated
    }

    // Pass the posts to the 'home' view
    return view('home', ['posts' => $posts]);
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// related to Post routes

Route::post('/create-post', [PostController::class, 'createPost']);
Route::post('/edit-post/{post}', [PostController::class, 'showEditscreen']);
Route::get('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post', [PostController::class, 'deletePost']);

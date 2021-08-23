<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\UserController;

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

Route::get('/', [CommentController::class, 'index']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/show_more', [CommentController::class, 'showMore'])->name('showMore');
Route::post('/add_comment', [CommentController::class, 'addComment'])->name('addComment')->middleware('can:create,App\Models\Comment');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('events', EventController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});

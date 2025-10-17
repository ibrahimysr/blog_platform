<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsPageController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\EventsPageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/yazilar', [PostsPageController::class, 'index'])->name('posts.list');
Route::get('/yazilar/{post:slug}', [PostDetailController::class, 'show'])->name('posts.show');
Route::post('/yazilar/{post:slug}/yorum', [PostDetailController::class, 'storeComment'])->name('posts.comment.store');
Route::post('/yazilar/{post:slug}/reaksiyon', [PostDetailController::class, 'react'])->name('posts.react');
Route::get('/etkinlikler', [EventsPageController::class, 'index'])->name('events.list');
Route::get('/etkinlik/{event:slug}', [EventsPageController::class, 'show'])->name('events.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galeri/{gallery:slug}', [GalleryController::class, 'show'])->name('galleries.show');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('events', EventController::class)->except(['show']);
        Route::get('galleries', [GalleryController::class, 'adminIndex'])->name('galleries.index');
        Route::resource('galleries', GalleryController::class)->except(['index']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});

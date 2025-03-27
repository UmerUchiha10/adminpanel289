<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);


});


require __DIR__.'/auth.php';


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/{slug}', [HomeController::class, 'blogDetails'])->name('blogDetails');



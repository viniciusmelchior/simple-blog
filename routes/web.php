<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
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

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); */

Route::get('/dashboard', [PostsController::class, 'userPosts'])->name('dashboard');

Route::get('posts', [PostsController::class, 'index']);

route::get('/', [PagesController::class, 'index']);
route::get('/services', [PagesController::class, 'services'])->name('services');
route::get('/about', [PagesController::class, 'about'])->name('about');

Route::resource('posts', PostsController::class);

require __DIR__.'/auth.php';




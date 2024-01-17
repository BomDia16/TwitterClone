<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
})->name('welcome');

// user
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/user/procurar', [UserController::class, 'procurar'])->name('user.procurar');
Route::post('/user/search', [UserController::class, 'search'])->name('user.search');
Route::post('/user/seguir', [UserController::class, 'seguir'])->name('user.seguir');
Route::resources(['/user' => UserController::class]);

// post
Route::resources(['/tweet' => PostController::class]);

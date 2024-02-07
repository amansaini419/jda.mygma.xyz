<?php

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
})->name('home'); */

Route::get('/blank', function () {
    return view('pages.blank');
})->name('blank');

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/summary', [Controllers\SummaryController::class, 'index'])->name('summary');
    // Route::get('/category/{slug}', [Controllers\CategoryController::class, 'view'])->name('category');
    Route::get('/category/{slug}', [Controllers\CategoryController::class, 'show'])->name('category');
    Route::post('/nominee/{nominee}/select', [Controllers\NomineeController::class, 'select'])->name('nominee.select');
    Route::post('/vote', [Controllers\VoteController::class, 'index'])->name('vote');
    // Route::post('/nominee/{nominee}/vote', [Controllers\NomineeController::class, 'vote'])->name('nominee.vote');
});

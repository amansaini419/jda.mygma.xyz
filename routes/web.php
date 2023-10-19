<?php

use App\Http\Controllers;
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

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/category/{slug}', [Controllers\CategoryController::class, 'view'])->name('category');

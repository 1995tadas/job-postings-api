<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostingController;
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


Route::prefix('job')->name('job.')->group(function () {
    Route::middleware('auth')->group(function(){
        Route::view('create', 'jobs.create')->name('create');
        Route::post('/', [PostingController::class, 'store'])->name('store');
        Route::middleware('author')->group(function(){
            Route::get('{id}/edit', [PostingController::class, 'edit'])->name('edit');
            Route::put('{id}', [PostingController::class, 'update'])->name('update');
        });
    });
    Route::get('/', [PostingController::class, 'index'])->name('index');
    Route::get('{id}/show', [PostingController::class, 'show'])->name('show');

});
Route::get('change',[LocaleController::class, 'change'])->name('locale.change');

Route::view('login','auth.login')->name('login');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::view('register','auth.register')->name('register');
Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('logout',[AuthController::class,'logout'])->name('logout');


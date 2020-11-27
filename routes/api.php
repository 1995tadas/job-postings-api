<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('job')->group(function () {
    Route::middleware('check.language')->group(function () {
        Route::get('{lang}/{id}/show', [PostingController::class, 'show'])->whereNumber('id');
        Route::get('{lang}/', [PostingController::class, 'index']);
    });
    Route::middleware('auth:api')->group(function () {
        Route::post('/', [PostingController::class, 'store']);
        Route::middleware('author')->group(function () {
            Route::put('{id}', [PostingController::class, 'update'])->whereNumber('id');
        });
    });
});

Route::prefix('auth')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::fallback(function(){
    return response()->json(['error' => 'Route don\'t exist or method not supported'], 404);
});

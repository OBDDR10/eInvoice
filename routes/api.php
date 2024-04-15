<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TestingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([], function () {
    Route::post('test', [TestingController::class, 'testing']);
    Route::post('register', [LoginController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', [LoginController::class, 'logout']);
    });
});


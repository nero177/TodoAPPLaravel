<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

Route::prefix('auth')
    ->middleware('api')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

Route::prefix('task')
    ->middleware('api')
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('/', 'all');
        Route::get('/search/{str}', 'search');
        Route::post('/', 'create');
        Route::post('{id}/complete', 'complete');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'delete');
    });
    
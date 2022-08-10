<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShortURLController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/short-url', [ShortURLController::class, 'shortURL']);
    Route::get('/to/{short}', [ShortURLController::class, 'redirect']);
    Route::get('/list-url', [ShortURLController::class, 'listURL']);
    Route::put('/edit-url/{id_url}', [ShortURLController::class, 'edit']);
    Route::delete('/delete-url/{id_url}', [ShortURLController::class, 'delete']);
    Route::get('/url-statistics/{id_url}', [ShortURLController::class, 'statistik']);
});

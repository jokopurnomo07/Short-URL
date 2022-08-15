<?php

use App\Http\Controllers\ShortURLWebController;
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
    return view('index');
});
Route::post('/',[ShortURLWebController::class, 'shortURL'])->name('shorten');
Route::get('/{code}',[ShortURLWebController::class, 'redirect'])->name('redirect');

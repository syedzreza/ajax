<?php

use App\Http\Controllers\AjaxController;
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
});

Route::get('/dashboard',[AjaxController::class,'index'])->name('index');
Route::post('/students',[AjaxController::class,'store'])->name('store');
Route::get('/show',[AjaxController::class,'show'])->name('show');

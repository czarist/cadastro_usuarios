<?php

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

//user logged
Route::group(['middleware' => 'auth.user'], function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    Route::get('/endereco/{id}', [App\Http\Controllers\AdressController::class, 'endereco'])->name('endereco');
});

//user login
Route::get('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/user_login', [App\Http\Controllers\UserController::class, 'user_login']);

//user register
Route::get('/register', [App\Http\Controllers\UserController::class, 'register']);
Route::post('/save_register', [App\Http\Controllers\UserController::class, 'save_register'])->name('save_user');

// adress register
Route::post('/save_adress', [App\Http\Controllers\AdressController::class, 'save_adress'])->name('save_adress');
Route::put('/update_adress', [App\Http\Controllers\AdressController::class, 'update_adress'])->name('update_adress');

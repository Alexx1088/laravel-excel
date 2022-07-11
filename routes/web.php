<?php

use Illuminate\Support\Facades\Auth;
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
// Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

/*Route::get('users/export/', [\App\Http\Controllers\UserController::class, 'export']);

Route::get('users/import/', [\App\Http\Controllers\UserController::class, 'import']);*/

Route::get('/users', [\App\Http\Controllers\UserController::class, 'list']);

Route::post('/import_user', [\App\Http\Controllers\UserController::class,
    'import_user'])->name('import_user');
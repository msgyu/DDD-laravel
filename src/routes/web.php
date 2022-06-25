<?php

use App\Http\Controllers\UserController;
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

Route::get('/users', [UserController::class, 'index']);
Route::get('/search', [UserController::class, 'search']);
Route::get('show', [UserController::class, 'show']);

Route::get('/', function () {
    return view('admin.index');
});
Route::get('/ui-elements', function () {
    return view('admin.ui-elements');
});
Route::get('/tables', function () {
    return view('admin.tables');
});
Route::get('/forms', function () {
    return view('admin.forms');
});
Route::get('/test', function () {
    return view('admin.test');
});

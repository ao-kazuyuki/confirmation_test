<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

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

Route::controller(ContactController::class)->group(function(){
  Route::get('/','index');
  Route::post('/','edit');
  Route::post('/confirm','confirm');
  Route::post('/thanks','add');
});

Route::middleware('auth')->group(function(){
  Route::controller(AuthController::class)->group(function(){
    Route::get('/admin', 'index');
    Route::get('/admin/search', 'search');
    Route::post('/admin/export', 'export');
    Route::delete('/admin/delete','destroy');
    Route::get('/admin/reset','index');
  });
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::redirect('/login', 'login');

Route::group(['middleware' => ['web', 'guest']], function(){
    
    Route::get('connect', [AuthController::class, 'connect'])->name('connect');
});

Route::group(['middleware' => ['web', 'MsGraphAuthenticated']], function(){
    
    Route::get('/', [HomeController::class, 'index'])->name('app.email-list');
    Route::get('logout-session', [AuthController::class, 'logout'])->name('app.logout');
});

Auth::routes();

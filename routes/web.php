<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\LoginController;
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

Route::prefix('backoffice')->group(function (){
    Route::get('/', [BackOfficeController::class, 'index'])->name('backoffice.index');
    Route::get('/login', [LoginController::class, 'loginBackOffice'])->name('backoffice.login');
    Route::post('/login', [LoginController::class, 'authBackOffice'])->name('backoffice.login');
});

Route::get('/login', function(){
    return view('login.index');
});

Route::get('/404', function(){
    abort('404');
});

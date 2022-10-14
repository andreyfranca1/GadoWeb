<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

// ROTAS DO BACKOFFICE
Route::group(['prefix' => 'backoffice'], function(){
    Route::get('', [BackOfficeController::class, 'index'])->name('backoffice.index')->middleware('auth:admin');
    Route::get('/login', [LoginController::class, 'loginBackOffice'])->name('backoffice.login');
    Route::post('/login', [LoginController::class, 'authBackOffice'])->name('backoffice.login');
    Route::get('/companies', [CompanyController::class, 'index'])->name('backoffice.companies')->middleware('auth:admin');
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index'])->name('backoffice.user.index')->middleware('auth:admin');
        Route::get('/new', [UserController::class, 'newUser'])->name('backoffice.user.new')->middleware('auth:admin');
    });
    Route::get('/logout', [LoginController::class, 'logoutBackOffice'])->name('backoffice.logout');
});

// ROTAS DO SITE
Route::get('/login', [LoginController::class, 'loginSite'])->name('site.login');
Route::post('/login', [LoginController::class, 'authSite'])->name('site.login');



Route::get('/', [HomeController::class, 'index'])->name('site.index')->middleware('auth');


Route::get('/404', function(){
    abort('404');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

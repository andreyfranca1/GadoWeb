<?php

use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BovinosController;
use App\Http\Controllers\RebanhosController;
use App\Http\Controllers\PesagensController;
use App\Http\Controllers\AlimentosController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\VacinasController;
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
    Route::group(['prefix' => 'companies'], function () {
        Route::get('', [CompanyController::class, 'index'])->name('backoffice.company.index')->middleware('auth:admin');
        Route::get('/new', [CompanyController::class, 'newCompany'])->name('backoffice.company.new')->middleware('auth:admin');

    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index'])->name('backoffice.user.index')->middleware('auth:admin');
        Route::get('/new', [UserController::class, 'newUser'])->name('backoffice.user.new')->middleware('auth:admin');
    });
    Route::get('/logout', [LoginController::class, 'logoutBackOffice'])->name('backoffice.logout');
});

// ROTAS DO SITE
Route::get('/login', [LoginController::class, 'loginSite'])->name('site.login');
Route::post('/login', [LoginController::class, 'authSite'])->name('site.login');
Route::get('/logout', [LoginController::class, 'logoutSite'])->name('site.logout');

Route::group(['prefix' => 'bovinos'], function (){
    Route::get('/adicionar', [BovinosController::class, 'addBovinoView'])->name('site.bovinos.adicionar');
    Route::get('/listar', [BovinosController::class, 'listBovinos'])->name('site.bovinos.listar');

});
Route::group(['prefix' => 'rebanhos'], function (){
    Route::get('/listar', [RebanhosController::class, 'listRebanhos'])->name('site.rebanhos.listar');
});

Route::group(['prefix' => 'pesagens'], function(){
    Route::get('/listar', [PesagensController::class, 'listPesagens'])->name('site.pesagens.listar');
});

Route::group(['prefix' => 'alimentos'], function(){
    Route::get('/listar', [AlimentosController::class, 'listAlimentos'])->name('site.alimentos.listar');
});

Route::group(['prefix' => 'medicamentos'], function(){
    Route::get('/listar', [MedicamentosController::class, 'listMedicamentos'])->name('site.medicamentos.listar');
});

Route::group(['prefix' => 'vacinas'], function(){
    Route::get('/listar', [VacinasController::class, 'listVacinas'])->name('site.vacinas.listar');
});


Route::get('/', [HomeController::class, 'index'])->name('site.index')->middleware('auth');


Route::get('/404', function(){
    abort('404');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\FuncionarioController;


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
    return redirect('/checkin');
});

//Route::get('/login', [LoginController::class, 'index']);


Route::get('/login', function () { return view('/login/login'); })->name('login');
Route::post('/login/checklogin',[LoginController::class, 'checklogin']);
Route::get('/checkin', [CheckinController::class, 'index']);
Route::post('/checkin/checkcpf', [CheckinController::class, 'checkcpf']);

Route::group(['middleware' => ['auth']], function () {

Route::get('/manage/main', [LoginController::class, 'successlogin']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/manage/cadastrarfuncionario', [FuncionarioController::class, 'index']);
Route::post('/manage/cadastrarfuncionario', [FuncionarioController::class, 'cadastrarFunc']);
Route::get('/manage/inserircheckin', [CheckinController::class, 'inserirCheckinView']);
Route::post('/manage/inserircheckin', [CheckinController::class, 'inserirCheckin']);



Route::get('/checkin/datatable', [CheckinController::class, 'datatable'])->name('checkin.datatable');

Route::get('/checkin/edit/{id}', [CheckinController::class, 'editcheckinView']);
Route::post('/checkin/edit/{id}', [CheckinController::class, 'editcheckin']);
Route::get('/checkin/delete/{id}', [CheckinController::class, 'deletecheckin']);

});




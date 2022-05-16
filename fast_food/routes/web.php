<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonAnController;
use App\Http\Controllers\DiaDiemController;
use App\Http\Controllers\LoaiMonAnController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SinglePageController;

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
Route::resource('app', SinglePageController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware('auth');

//Resource
Route::resource('monAn', MonAnController::class)->middleware('auth');
Route::resource('loaiMonAn', LoaiMonAnController::class)->middleware('auth');
Route::resource('diaDiem', DiaDiemController::class)->middleware('auth');

//Authorize
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'checkRegister'])->name('checkRegister');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

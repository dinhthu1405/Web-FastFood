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
Route::get('/diaDiem', [DiaDiemController::class, 'index'])->name('diaDiem.index')->middleware('auth');
Route::post('/diaDiem', [DiaDiemController::class, 'store'])->name('diaDiem.store')->middleware('auth');
Route::get('/diaDiem/sua/{id}', [DiaDiemController::class, 'edit'])->name('diaDiem.edit')->middleware('auth');
Route::post('/diaDiem/sua/{id}', [DiaDiemController::class, 'update'])->name('diaDiem.update')->middleware('auth');
// Route::post('/diaDiem/them', 'DiaDiemController@store')->middleware('auth');

//Xoá dữ liệu
Route::get('/loaiMonAn/xoa/{id}', [LoaiMonAnController::class, 'xoa'])->name('loaiMonAn.xoa')->middleware('auth');
Route::get('/diaDiem/xoa/{id}', [DiaDiemController::class, 'xoa'])->name('diaDiem.xoa')->middleware('auth');
Route::get('/monAn/xoa/{id}', [MonAnController::class, 'xoa'])->name('monAn.xoa')->middleware('auth');

//Tìm kiếm
Route::post('/monAn/search/', [MonAnController::class, 'search'])->name('monAn.search')->middleware('auth');
Route::post('/loaiMonAn/search/', [LoaiMonAnController::class, 'search'])->name('loaiMonAn.search')->middleware('auth');
Route::post('/diaDiem/search/', [DiaDiemController::class, 'search'])->name('diaDiem.search')->middleware('auth');

//Hình ảnh
Route::get('/monAn/images/{id}', [MonAnController::class, 'images'])->name('monAn.images')->middleware('auth');

//Authorize
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'checkRegister'])->name('checkRegister');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

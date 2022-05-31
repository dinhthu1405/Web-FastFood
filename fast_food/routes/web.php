<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonAnController;
use App\Http\Controllers\DiaDiemController;
use App\Http\Controllers\LoaiMonAnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\TrangThaiDonHangController;
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
Route::resource('taiKhoan', UserController::class)->middleware('auth');
Route::resource('donHang', DonHangController::class)->middleware('auth');
Route::resource('trangThaiDonHang', TrangThaiDonHangController::class)->middleware('auth');
Route::resource('chiTietDonHang', ChiTietDonHangController::class)->middleware('auth');
Route::resource('danhGia', DanhGiaController::class)->middleware('auth');
Route::resource('binhLuan', BinhLuanController::class)->middleware('auth');

// Route::get('binhLuan/{id}/edit', [BinhLuanController::class, 'edit'])->name('binhLuan.edit')->middleware('auth');
// Route::post('binhLuan/{id}', [BinhLuanController::class, 'update'])->name('binhLuan.update')->middleware('auth');

// Route::get('/diaDiem', [DiaDiemController::class, 'index'])->name('diaDiem.index')->middleware('auth');
// Route::post('/diaDiem', [DiaDiemController::class, 'store'])->name('diaDiem.store')->middleware('auth');
// Route::get('/diaDiem/{id}', [DiaDiemController::class, 'edit'])->name('diaDiem.edit')->middleware('auth');
// Route::post('/diaDiem/{id}', [DiaDiemController::class, 'update'])->name('diaDiem.update')->middleware('auth');
// Route::post('/diaDiem/them', 'DiaDiemController@store')->middleware('auth');

//Xoá dữ liệu
Route::get('/loaiMonAn/xoa/{id}', [LoaiMonAnController::class, 'xoa'])->name('loaiMonAn.xoa')->middleware('auth');
Route::get('/diaDiem/xoa/{id}', [DiaDiemController::class, 'xoa'])->name('diaDiem.xoa')->middleware('auth');
Route::get('/monAn/xoa/{id}', [MonAnController::class, 'xoa'])->name('monAn.xoa')->middleware('auth');
Route::get('/taiKhoan/khoa_mo/{id}', [UserController::class, 'khoa_mo'])->name('taiKhoan.khoa_mo')->middleware('auth');
Route::get('/trangThaiDonHang/xoa/{id}', [TrangThaiDonHangController::class, 'xoa'])->name('trangThaiDonHang.xoa')->middleware('auth');
Route::get('/donHang/xoa/{id}', [DonHangController::class, 'xoa'])->name('donHang.xoa')->middleware('auth');
Route::get('/danhGia/xoa/{id}', [DanhGiaController::class, 'xoa'])->name('danhGia.xoa')->middleware('auth');
Route::get('/binhLuan/xoa/{id}', [BinhLuanController::class, 'xoa'])->name('binhLuan.xoa')->middleware('auth');

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

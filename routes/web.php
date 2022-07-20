<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\LoaiGiamGiaController;
use App\Http\Controllers\AnhBiaController;
use App\Http\Controllers\DiemMuaHangController;
use App\Http\Controllers\ThongKeController;
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
Route::resource('maGiamGia', MaGiamGiaController::class)->middleware('auth');
Route::resource('loaiGiamGia', LoaiGiamGiaController::class);
// Route::resource('anhBia', AnhBiaController::class)->middleware('auth');
Route::resource('anhBias', AnhBiaController::class)->middleware('auth');
Route::resource('diemMuaHang', DiemMuaHangController::class)->middleware('auth');
Route::resource('thongKe', ThongKeController::class)->middleware('auth');

//Thống kê
Route::get('/thongKe/xuatFilePDF/{quy}/{thang}/{tu_ngay}/{den_ngay}/{topDH}/{thongKe}', [ThongKeController::class, 'exportPDF'])->name('thongKe.exportPDF')->middleware('auth');
Route::get('/thongKe/xuatFileExcel/{quy}/{thang}/{tu_ngay}/{den_ngay}/{topDH}/{thongKe}', [ThongKeController::class, 'exportExcel'])->name('thongKe.exportExcel')->middleware('auth');

// Route::get('/thongKe/thongKeDonHang/{thongKe}', [ThongKeController::class, 'thongKeDonHang'])->name('thongKe.thongKeDonHang')->middleware('auth');
// Route::get('/thongKe/thongKeDonHangs/', [ThongKeController::class, 'thongKeDonHangs'])->name('thongKe.thongKeDonHangs')->middleware('auth');
// Route::get('/thongKe/thongKeTrangThaiDonHangs/', [ThongKeController::class, 'thongKeDonHangs'])->name('thongKe.thongKeDonHangs')->middleware('auth');
// Route::get('/home', [HomeController::class, 'getTrangThaiDonHang'])->name('home.getTrangThaiDonHang')->middleware('auth');

//Xoá dữ liệu
Route::post('/loaiMonAn/xoa/{id}', [LoaiMonAnController::class, 'xoa'])->name('loaiMonAn.xoa')->middleware('auth');
Route::post('/diaDiem/xoa/{id}', [DiaDiemController::class, 'xoa'])->name('diaDiem.xoa')->middleware('auth');
Route::post('/monAn/xoa/{id}', [MonAnController::class, 'xoa'])->name('monAn.xoa')->middleware('auth');
Route::get('/taiKhoan/khoa_mo/{id}', [UserController::class, 'khoa_mo'])->name('taiKhoan.khoa_mo')->middleware('auth');
Route::post('/trangThaiDonHang/xoa/{id}', [TrangThaiDonHangController::class, 'xoa'])->name('trangThaiDonHang.xoa')->middleware('auth');
Route::post('/donHang/xoa/{id}', [DonHangController::class, 'xoa'])->name('donHang.xoa')->middleware('auth');
Route::get('/danhGia/xoa/{id}', [DanhGiaController::class, 'xoa'])->name('danhGia.xoa')->middleware('auth');
Route::get('/binhLuan/xoa/{id}', [BinhLuanController::class, 'xoa'])->name('binhLuan.xoa')->middleware('auth');
Route::get('/maGiamGia/xoa/{id}', [MaGiamGiaController::class, 'xoa'])->name('maGiamGia.xoa')->middleware('auth');
Route::post('/loaiGiamGia/xoa/{id}', [LoaiGiamGiaController::class, 'xoa'])->name('loaiGiamGia.xoa')->middleware('auth');
Route::get('/anhBias/xoa/{id}', [AnhBiaController::class, 'xoa'])->name('anhBias.xoa')->middleware('auth');
Route::post('/diemMuaHang/xoa/{id}', [DiemMuaHangController::class, 'xoa'])->name('diemMuaHang.xoa')->middleware('auth');
Route::post('/anhBia/xoa/{id}', [AnhBiaController::class, 'xoa'])->name('anhBia.xoa')->middleware('auth');

//Xoá nhiều
Route::post('/monAn/xoaNhieu', [MonAnController::class, 'xoaNhieu'])->name('monAn.xoaNhieu')->middleware('auth');
Route::post('/loaiMonAn/xoaNhieu', [LoaiMonAnController::class, 'xoaNhieu'])->name('loaiMonAn.xoaNhieu')->middleware('auth');
Route::post('/diaDiem/xoaNhieu', [DiaDiemController::class, 'xoaNhieu'])->name('diaDiem.xoaNhieu')->middleware('auth');
Route::post('/donHang/xoaNhieu', [DonHangController::class, 'xoaNhieu'])->name('donHang.xoaNhieu')->middleware('auth');
Route::post('/trangThaiDonHang/xoaNhieu', [TrangThaiDonHangController::class, 'xoaNhieu'])->name('trangThaiDonHang.xoaNhieu')->middleware('auth');
Route::post('/loaiGiamGia/xoaNhieu', [LoaiGiamGiaController::class, 'xoaNhieu'])->name('loaiGiamGia.xoaNhieu')->middleware('auth');
Route::post('/anhBia/xoaNhieu', [AnhBiaController::class, 'xoaNhieu'])->name('anhBia.xoaNhieu')->middleware('auth');
Route::post('/diemMuaHang/xoaNhieu', [DiemMuaHangController::class, 'xoaNhieu'])->name('diemMuaHang.xoaNhieu')->middleware('auth');


//Tìm kiếm
Route::get('/timKiemMonAn', [MonAnController::class, 'search'])->name('monAn.search')->middleware('auth');
Route::get('/timKiemLoaiMonAn', [LoaiMonAnController::class, 'search'])->name('loaiMonAn.search')->middleware('auth');
Route::get('/timKiemDiaDiem', [DiaDiemController::class, 'search'])->name('diaDiem.search')->middleware('auth');
Route::get('/timKiemTaiKhoan', [UserController::class, 'search'])->name('taiKhoan.search')->middleware('auth');
Route::get('/timKiemDonHang/{taiKhoan}', [DonHangController::class, 'searchDonHang'])->name('donHang.searchDonHang')->middleware('auth');
Route::get('/timKiemChiTietDonHang', [DonHangController::class, 'searchChiTietDonHang'])->name('donHang.searchChiTietDonHang')->middleware('auth');
Route::get('/timKiemTrangThaiDonHang', [TrangThaiDonHangController::class, 'search'])->name('trangThaiDonHang.search')->middleware('auth');
Route::get('/timKiemDanhGia', [DanhGiaController::class, 'search'])->name('danhGia.search')->middleware('auth');
Route::get('/timKiemBinhLuan', [BinhLuanController::class, 'search'])->name('binhLuan.search')->middleware('auth');
Route::get('/timKiemLoaiGiamGia', [LoaiGiamGiaController::class, 'search'])->name('loaiGiamGia.search')->middleware('auth');
Route::get('/timKiemMaGiamGia', [MaGiamGiaController::class, 'search'])->name('maGiamGia.search')->middleware('auth');
Route::get('/timKiemDiemMuaHang', [DiemMuaHangController::class, 'search'])->name('diemMuaHang.search')->middleware('auth');

//Hình ảnh
Route::get('/monAn/images/{id}', [MonAnController::class, 'images'])->name('monAn.images')->middleware('auth');

//Route
Route::get('/donHang/{id}/{user_id}/{nguoi_giao_hang_id}/{trang_thai_don_hang_id}', [DonHangController::class, 'index1'])->name('donHang.index1')->middleware('auth');
Route::get('/taiKhoan/{user_id}/{nguoi_giao_hang_id}', [UserController::class, 'index1'])->name('taiKhoan.index1')->middleware('auth');
Route::get('/loaiMonAns/{loai_mon_an_id}', [LoaiMonAnController::class, 'index1'])->name('loaiMonAn.index1')->middleware('auth');
Route::get('/diaDiems/{dia_diem_id}', [DiaDiemController::class, 'index1'])->name('diaDiem.index1')->middleware('auth');
Route::get('/trangThaiDonHangs/{trang_thai_don_hang_id}', [TrangThaiDonHangController::class, 'index1'])->name('trangThaiDonHang.index1')->middleware('auth');
Route::get('/loaiGiamGias/{loai_giam_gia_id}', [LoaiGiamGiaController::class, 'index1'])->name('loaiGiamGia.index1')->middleware('auth');
Route::get('/monAns/{mon_an_id}', [MonAnController::class, 'index1'])->name('monAn.index1')->middleware('auth');
Route::get('/danhGias/{id}', [DanhGiaController::class, 'index1'])->name('danhGias.index1')->middleware('auth');

//Ajax
Route::get('/danhSach_loaiMonAn', [LoaiMonAnController::class, 'indexAjax'])->name('loaiMonAn.indexAjax')->middleware('auth');
Route::get('/danhSach_trangThaiDonHang', [TrangThaiDonHangController::class, 'indexAjax'])->name('trangThaiDonHang.indexAjax')->middleware('auth');
Route::get('/danhSach_loaiGiamGia', [LoaiGiamGiaController::class, 'indexAjax'])->name('loaiGiamGia.indexAjax')->middleware('auth');

//Authorize
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'checkRegister'])->name('checkRegister');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

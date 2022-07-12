<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\UserApi;
use App\Http\Controllers\API\MonAnApi;
use App\Http\Controllers\API\HoaDonApi;
use App\Http\Controllers\API\MaGiamGiaApi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [UserApi::class,'login']);
    Route::post('signup', [UserApi::class,'signup']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout',[UserApi::class,'logout']);
        Route::get('user', [UserApi::class,'user']);
    });
});
Route::get('monan',[MonAnApi::class,'index']);
Route::get('monan/show/{monAn}',[MonAnApi::class,'showMonAn']);
Route::get('monan/showdanhgia/{monAn}',[MonAnApi::class,'showDanhGia']);
Route::get('monan/loaimonan',[MonAnApi::class,'LoaiMonAn']);
Route::post('monan/yeuthich',[MonAnApi::class,'FoodFavorite']);
Route::get('monan/loaimonan/{loaiMonAn}',[MonAnApi::class,'MonAnWithType']);
Route::post('danhgia',[MonAnApi::class,'storeDanhGia']);
Route::get('donhang',[HoaDonApi::class,'index']);
Route::post('donhang/update/{donHang}',[HoaDonApi::class,'update']);
Route::post('donhang/create',[HoaDonApi::class,'store']);
Route::post('donhang/createdetail',[HoaDonApi::class,'storeCTDH']);
Route::get('donhang/ctdonhang/{ctdonhang}/delete',[HoaDonApi::class,'destroyCTDH']);
Route::get('donhang/{donHang}/delete',[HoaDonApi::class,'destroy']);
Route::get('donhang',[HoaDonApi::class,'index']);
Route::get('anhbia',[MonAnApi::class,'allAnhBia']);
Route::post('user/create',[UserApi::class,'store']);
Route::get('user/{id}',[UserApi::class,'FindUser']);
Route::get('yeuthich/destroy/{monAn}',[MonAnApi::class,'destroyLike']);


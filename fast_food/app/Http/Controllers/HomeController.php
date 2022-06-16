<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\DonHang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $choXacNhan = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 1)->count();
        $xacNhanGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 2)->count();
        $choGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 3)->count();
        $dangGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 4)->count();
        $daNhan = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 5)->count();
        $xacNhanDaGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 6)->count();
        $donHangBoom = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 7)->count();
        $hoanThanh = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 8)->count();
        $tongDonHang = DonHang::where('trang_thai', 1)->count();
        return view('home', compact('choXacNhan', 'xacNhanGiao', 'choGiao', 'dangGiao', 'daNhan', 'xacNhanDaGiao', 'donHangBoom', 'hoanThanh', 'tongDonHang'));
    }
}

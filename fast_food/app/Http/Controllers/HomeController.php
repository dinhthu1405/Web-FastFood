<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\DonHang;
use App\Models\User;
use App\Models\MaGiamGia;
use App\Models\TrangThaiDonHang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GNAHotelSolutions\Weather\Weather;
use Carbon\Carbon;
use Vemcogroup\Weather\Providers\Provider;
use Vemcogroup\Weather\Request as WeatherRequest;
use Illuminate\Support\Arr;

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
        $ngay_hien_tai = Carbon::now()->toDateString();
        // $ngay_hom_nay = '2022-07-12';
        // dd($ngay_hien_tai);
        $choXacNhan = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 1)
            ->where(function ($query) use ($ngay_hien_tai) {
                $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
            })->count();
        // dd($choXacNhan);
        $xacNhanGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 2)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $choGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 3)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $dangGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 4)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $daNhan = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 5)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $xacNhanDaGiao = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 6)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $donHangBoom = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 7)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $hoanThanh = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 8)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $tongDonHang = DonHang::where('trang_thai', 1)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->count();
        $tongTien = DonHang::where('trang_thai', 1)->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->sum('tong_tien');
        $hinhThucThanhToanThe = DonHang::where('trang_thai', 1)->where('loai_thanh_toan', 'Thẻ')->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->sum('tong_tien');
        $hinhThucThanhToanTienMat = DonHang::where('trang_thai', 1)->where('loai_thanh_toan', 'Tiền mặt')->where(function ($query) use ($ngay_hien_tai) {
            $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($ngay_hien_tai)) . '%');
        })->sum('tong_tien');
        $result = DB::select(DB::raw("SELECT COUNT(*) as tong_don_hang, trang_thai_don_hang_id FROM don_hangs WHERE trang_thai = 1 AND ngay_lap_dh LIKE  '%" . date('Y-m-d', strtotime($ngay_hien_tai)) . "%' GROUP BY trang_thai_don_hang_id"));
        $tenTrangThai = TrangThaiDonHang::all()->where('trang_thai', 1);

        $chartData = "";
        $chartLabel = array();
        $chartSeries = array();
        foreach ($result as $list) {
            // $chartData .= "['" . $list->trang_thai_don_hang_id . "', " . $list->tong_don_hang . "],";
            foreach ($tenTrangThai as $ten) {
                if ($ten->id == $list->trang_thai_don_hang_id) {
                    $chartLabel[] = $ten->ten_trang_thai;
                }
            }
            $chartSeries[] = $list->tong_don_hang;
        }
        $getTrangThaiDonHang = array('ten_trang_thai' => $chartLabel, 'so_luong' => $chartSeries);
        // $weather = new Weather();
        
        // $ten_thanh_pho = $weather->get('girona,es');
        $lstDonHang = DonHang::all()->where('trang_thai', 1)->sortByDesc('ngay_lap_dh')->take(5);
        $trangThaiDonHang = DonHang::select()->where('trang_thai', 1)->get();
        $lstTaiKhoan = User::all();

        //Khoá mã giảm giá
        $ngay_ket_thuc_ma_giam_gia = MaGiamGia::all()->where('trang_thai', 1);
        foreach ($ngay_ket_thuc_ma_giam_gia as $ma_giam_gia) {
            if (date('Y-m-d', strtotime($ma_giam_gia->ngay_ket_thuc)) == $ngay_hien_tai) {
                // dd('đúng');
                $ma_giam_gia->trang_thai = 0;
                $ma_giam_gia->save();
            }
        }
        //Khoá tài khoản khi hết 3 tháng
        // $lstTaiKhoan_Khoa = User::onlyTrashed()->get();
        // foreach ($lstTaiKhoan_Khoa as $taiKhoan) {
        //     // $xoa_tai_khoan = Carbon::parse($taiKhoan->deleted_at)->addMonth(3)->format('Y-m-d');
        //     $taiKhoan->deleted_at = $ngay_hien_tai;
        //     dd(date('Y-m-d', strtotime($taiKhoan->deleted_at)) == $ngay_hien_tai);
        //     if (date('Y-m-d', strtotime($taiKhoan->deleted_at)) == $ngay_hien_tai) {

        //     }
        // }
        // dd($lstTaiKhoan_Khoa);

        return view('home', compact('choXacNhan', 'xacNhanGiao', 'choGiao', 'dangGiao', 'daNhan', 'xacNhanDaGiao', 'donHangBoom', 'hoanThanh', 'tongDonHang', 'getTrangThaiDonHang', 'chartLabel', 'chartSeries', 'lstDonHang', 'lstTaiKhoan', 'hinhThucThanhToanThe', 'hinhThucThanhToanTienMat', 'tongTien', 'trangThaiDonHang'));
    }
}

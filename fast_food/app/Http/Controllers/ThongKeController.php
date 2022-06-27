<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DonHang;
use App\Models\TrangThaiDonHang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\DonHangExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Iterator\PathFilterIterator;

class ThongKeController extends Controller
{

    public function index()
    {
        //
        $lstDonHang = DonHang::where('trang_thai', 1)->paginate(5);
        $lstTaiKhoan = User::all();
        $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);
        $value = 0;
        $value_top = 0;
        $value_loai = 0;
        $tu_ngay = '01-01-01';
        $den_ngay = '01-01-01';
        $thongKe = 0;
        $topDH = 0;
        return view('component/thong-ke/thongke-donhang', compact('lstDonHang', 'lstTrangThaiDonHang', 'lstTaiKhoan', 'value', 'value_top', 'value_loai', 'tu_ngay', 'den_ngay', 'thongKe', 'topDH'));
    }

    public function show($thongKe)
    {
        // $lstDonHang = DonHang::where('trang_thai', 1)->paginate(5);
        // dd($thongKe);
        $lstTaiKhoan = User::all();
        $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);
        $value = 0;
        $value_loai = 0;
        $value_top = 0;
        if (isset(request()->tu_ngay) && isset(request()->tu_ngay)) {
            $tu_ngay = request()->tu_ngay;
            $den_ngay = request()->den_ngay;
        } else {
            $tu_ngay = '01-01-01';
            $den_ngay = '01-01-01';
        }
        $topDH = request()->TOPDH;
        //Thống kê theo ngày tháng năm
        if ($thongKe == 1) {
            if ($tu_ngay && $den_ngay) {
                $lstDonHang = DonHang::where('trang_thai', 1)->whereBetween('ngay_lap_dh', [$tu_ngay, $den_ngay])->paginate(5);
                $value = 1;
                $value_loai = 1;
            }
        }
        //Thống kê theo ngày hiện tại
        else if ($thongKe == 2) {
            $lstDonHang = DonHang::where('trang_thai', 1)->where('ngay_lap_dh', Carbon::today())->paginate(5);
            $value = 2;
            $value_loai = 1;
        }
        //Thống kê theo ngày hôm qua
        else if ($thongKe == 3) {
            $lstDonHang = DonHang::where('trang_thai', 1)->where('ngay_lap_dh', Carbon::yesterday())->paginate(5);
            $value = 3;
            $value_loai = 1;
        }
        //Thống kê theo tuần hiện tại
        else if ($thongKe == 4) {
            $this_week = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            $lstDonHang = DonHang::where('trang_thai', 1)->whereBetween('ngay_lap_dh', $this_week)->paginate(5);
            $value = 4;
            $value_loai = 1;
        }
        //Thống kê theo tuần trước
        else if ($thongKe == 5) {
            $last_week = [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()];
            $lstDonHang = DonHang::where('trang_thai', 1)->whereBetween('ngay_lap_dh', $last_week)->paginate(5);
            $value = 5;
            $value_loai = 1;
        }
        //Thống kê theo tháng hiện tại
        else if ($thongKe == 6) {
            $lstDonHang = DonHang::where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->format('m'))->paginate(5);
            $value = 6;
            $value_loai = 1;
        }
        //Thống kê theo tháng trước
        else if ($thongKe == 7) {
            $lstDonHang = DonHang::where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->subMonth()->month)->paginate(5);
            $value = 7;
            $value_loai = 1;
        }
        //Thống kê theo năm hiện tại
        else if ($thongKe == 8) {
            $lstDonHang = DonHang::where('trang_thai', 1)->whereYear('ngay_lap_dh', Carbon::now()->year)->paginate(5);
            $value = 8;
            $value_loai = 1;
        }
        //Thống kê theo top các đơn hàng lớn nhất
        else if ($thongKe == 9) {
            if ($topDH == 1) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(5);
                })->paginate(5);
                $value = 9;
                $value_top = 1;
                $value_loai = 1;
            } else if ($topDH == 2) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(10);
                })->paginate(5);
                $value = 9;
                $value_top = 2;
                $value_loai = 1;
            } else if ($topDH == 3) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(15);
                })->paginate(5);
                $value = 9;
                $value_top = 3;
                $value_loai = 1;
            }
        }
        //Thống kê đơn hàng chưa nhận
        else if ($thongKe == 10) {
            $lstDonHang = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 1)->paginate(5);
            $value = 10;
            $value_loai = 2;
        }
        //Thống kê đơn hàng đã nhận
        else if ($thongKe == 11) {
            $lstDonHang = DonHang::where('trang_thai', 1)->where('trang_thai_don_hang_id', 2)->paginate(5);
            $value = 11;
            $value_loai = 2;
        }
        // dd($thongKe);
        return view('component/thong-ke/thongke-donhang', compact('lstDonHang', 'lstTrangThaiDonHang', 'lstTaiKhoan', 'value', 'value_top', 'value_loai', 'tu_ngay', 'den_ngay', 'thongKe', 'topDH'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        // $lstTaiKhoan = User::all()->where('trang_thai', 1);
        // $lstDonHang = DonHang::all()->where('trang_thai', 1);
        // $lstDiemMuaHang = ThongKeController::where('trang_thai', 1)->where(function ($query) use ($search) {
        //     $query->where('so_diem', 'LIKE', '%' . $search . '%');
        // })->paginate(5);

        return view('component/diem-mua-hang/diemmuahang-show', compact('lstDiemMuaHang', 'lstDonHang', 'lstTaiKhoan', 'request'));
    }

    public function exportExcel($tu_ngay, $den_ngay, $topDH, $thongKe)
    {
        return (new DonHangExport($tu_ngay, $den_ngay, $topDH, $thongKe))->download('DonHangExport.xlsx');
        // $lstDonHang = DonHang::all();
        // $lstTaiKhoan = User::all();
        // $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);
        // return view('component/thong-ke/thongke-xuatfileexcel', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang'));
    }

    public function exportPDF($tu_ngay, $den_ngay, $topDH, $thongKe)
    {
        $lstTaiKhoan = User::all();
        $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);

        if ($thongKe == 0) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1);
        }
        //Thống kê theo ngày tháng năm
        else if ($thongKe == 1) {
            $lstDonHang = DonHang::where('trang_thai', 1)->whereBetween('ngay_lap_dh', [$tu_ngay, $den_ngay])->get();
        }
        //Thống kê theo ngày hiện tại
        else if ($thongKe == 2) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('ngay_lap_dh', Carbon::today());
        }
        //Thống kê theo ngày hôm qua
        else if ($thongKe == 3) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('ngay_lap_dh', Carbon::yesterday());
        }
        //Thống kê theo tuần hiện tại
        else if ($thongKe == 4) {
            $this_week = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereBetween('ngay_lap_dh', $this_week);
        }
        //Thống kê theo tuần trước
        else if ($thongKe == 5) {
            $last_week = [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()];
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereBetween('ngay_lap_dh', $last_week);
        }
        //Thống kê theo tháng hiện tại
        else if ($thongKe == 6) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->format('m'));
        }
        //Thống kê theo tháng trước
        else if ($thongKe == 7) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->subMonth()->month);
        }
        //Thống kê theo năm hiện tại
        else if ($thongKe == 8) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereYear('ngay_lap_dh', Carbon::now()->year);
        }
        //Thống kê theo top các đơn hàng lớn nhất
        else if ($thongKe == 9) {
            if ($topDH == 1) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(5);
                })->get();
            } else if ($topDH == 2) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(10);
                })->get();
            } else if ($topDH == 3) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(15);
                })->get();
            }
        }
        //Thống kê đơn hàng chưa nhận
        else if ($thongKe == 10) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('trang_thai_don_hang_id', 1);
        }
        //Thống kê đơn hàng đã nhận
        else if ($thongKe == 11) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('trang_thai_don_hang_id', 2);
        }
        // require_once 'dompdf/autoload.inc.php'; //Nằm cùng cấp với Controller, dùng cái này cũng được hoặc ở vendor cũng được

        view()->share('lstDonHang', $lstDonHang);
        $pdf = PDF::loadView('component/thong-ke/thongke-xuatfilepdf', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang', 'thongKe', 'tu_ngay', 'den_ngay'))->setOptions([
            'defaultFont' => 'times'
        ]);
        // $pdf->setWatermarkImage(public_path('assets/img/icons/unicons/logo.png'));
        // $pdf->getDomPDF()->setHttpContext(
        //     stream_context_create([
        //         'ssl' => [
        //             'allow_self_signed' => TRUE,
        //             'verify_peer' => FALSE,
        //             'verify_peer_name' => FALSE,
        //         ]
        //     ])
        // );
        // return $pdf;
        return $pdf->download('DonHangExport.pdf');
        // return view('component/thong-ke/thongke-xuatfilepdf', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang', 'thongKe', 'tu_ngay', 'den_ngay'));
    }
}

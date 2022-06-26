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
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

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
        $tu_ngay = '1/1/1';
        $den_ngay = '1/1/1';
        $thongKe = 0;
        $topDH = 0;
        // dd($tu_ngay, $den_ngay);
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
        $tu_ngay = request()->tu_ngay;
        $den_ngay = request()->den_ngay;
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
        return view('component/thong-ke/thongke-donhang', compact('lstDonHang', 'lstTrangThaiDonHang', 'lstTaiKhoan', 'value', 'value_top', 'value_loai', 'tu_ngay', 'den_ngay', 'thongKe', 'topDH'));
        // return Redirect::route('thongKe.thongKeDonHangs')->with('lstDonHang', $lstDonHang)->with('lstTaiKhoan', $lstTaiKhoan)->with('value', $value);
        // return Redirect::route('thongKe.index')->with('lstDonHang', $lstDonHang)->with('lstTaiKhoan', $lstTaiKhoan)->with('value', $value);
        // return $this->thongKeDonHangs($lstDonHang, $lstTaiKhoan, $value, $value_top, $value_loai);
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

    public function getAll()
    {
        return collect(DB::select('select * from don_hangs'));
    }

    public function exportExcel($tu_ngay, $den_ngay, $topDH, $thongKe)
    {
        // // return Excel::download(new DonHangExport(), 'DonHangExport.xlsx');

        $lstTaiKhoan = User::all();
        $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);
        // $topDH = request()->TOPDH;   
        if ($thongKe == 0) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1);
        }
        //Thống kê theo ngày tháng năm
        else if ($thongKe == 1) {
            $lstDonHang = DonHang::where('trang_thai', 1)->where(function ($query) use ($tu_ngay, $den_ngay) {
                $query->whereBetween('ngay_lap_dh', [$tu_ngay, $den_ngay]);
            })->get();
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
        // // dd($topDH);
        // // Excel::raw(function ($excel) use($lstDonHang, $lstTaiKhoan, $lstTrangThaiDonHang) {

        // //     $excel->sheet('Excel sheet', function ($sheet) use($lstDonHang, $lstTaiKhoan, $lstTrangThaiDonHang) {
        // //         $sheet->loadView('component/thong-ke/thongke-xuatfilepdf', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang'));
        // //         $sheet->setOrientation('landscape');
        // //     });
        // //     return $excel->download('DonHangExport.xlsx');
        // // });

        // // Excel::create('Laravel Excel', function ($excel) use ($something, $something2) {

        // //     $excel->sheet('Excel sheet', function ($sheet) use ($something, $something2) {
        // //         $sheet->loadView('something')->with('something', $something)
        // //             ->with('something2', $something2);
        // //         $sheet->setOrientation('landscape');
        // //     });
        // // })->export('xlsx');

        // // return Excel::download(new DonHangExport($tu_ngay, $den_ngay, $topDH, $thongKe), 'invoices.xlsx');
        // // return (new DonHangExport)->forWhat($tu_ngay, $den_ngay, $topDH, $thongKe)->download('DonHangExport.xlsx');
        // return Excel::download((new DonHangExport)->forWhat($tu_ngay, $den_ngay, $topDH, $thongKe), 'DonHangExport.xlsx');
        // return (new DonHangExport($tu_ngay, $den_ngay, $topDH, $thongKe))->download('DonHangExport.xlsx');
        // $point = [
        //     [1, 2, 3],
        //     [2, 5, 9]
        // ]
        // $data = (object) array(
        //         'points' => $point,
        //     );
        // $export = new DonHangExport([$lstDonHang]);
        return Excel::download(new DonHangExport, 'DonHangExport.xlsx');
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
            $lstDonHang = DonHang::where('trang_thai', 1)->where(function ($query) use ($tu_ngay, $den_ngay) {
                $query->whereBetween('ngay_lap_dh', [$tu_ngay, $den_ngay]);
            })->get();
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
        view()->share('lstDonHang', $lstDonHang);
        $pdf = PDF::loadView('component/thong-ke/thongke-xuatfilepdf', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('DonHangExport.pdf');
    }
}

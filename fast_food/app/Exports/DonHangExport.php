<?php

namespace App\Exports;

use App\Models\DonHang;
use App\Models\User;
use App\Models\TrangThaiDonHang;
use App\Controllers\DonHangController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonHangExport implements FromCollection, WithCustomStartCell, ShouldAutoSize, WithHeadings
{
    use Exportable;
    public $tu_ngay, $den_ngay, $topDH, $thongKe;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DonHang::all()->where('trang_thai', 1);
    }


    public function forWhat($tu_ngay, $den_ngay, $topDH, $thongKe)
    {
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
        // dd($lstDonHang);
        return $lstDonHang;
        // return view('component/thong-ke/thongke-xuatfilepdf', compact('lstDonHang', 'lstTaiKhoan', 'lstTrangThaiDonHang'));
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function headings(): array
    {
        return [
         'id',
         'Ngày lập đơn hàng',
         'Tổng tiền',
         'Người giao hàng',
         'Người đặt',
         'Địa chỉ',
         'Loại thanh toán',
         'Trạng thái đơn hàng',
		];
	}
}

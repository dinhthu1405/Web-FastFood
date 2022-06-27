<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\DonHang;
use App\Models\User;
use App\Models\TrangThaiDonHang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell; //Chỉnh dữ liệu bắt đầu xuất ra từ dòng mấy
use Maatwebsite\Excel\Concerns\ShouldAutoSize; //Tự động canh chỉnh cột
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings; //Dùng để xuất hình ảnh
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing; //Dùng để xuất hình ảnh
use Maatwebsite\Excel\Concerns\WithStyles; //Dùng để canh chỉnh style trong excel
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; //Dùng để canh chỉnh style trong excel
use PhpOffice\PhpSpreadsheet\Style\Color; //Dùng để canh chỉnh style màu cell trong excel


class DonHangExport implements
    ShouldAutoSize,
    WithCustomStartCell,
    WithColumnFormatting,
    FromView,
    WithStyles,
    WithDrawings
{
    use Exportable, RegistersEventListeners;
    public $tu_ngay, $den_ngay, $topDH, $thongKe;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($tu_ngay, $den_ngay, $topDH, $thongKe)
    {
        $this->tu_ngay = $tu_ngay;
        $this->den_ngay = $den_ngay;
        $this->topDH = $topDH;
        $this->thongKe = $thongKe;
    }

    public function view(): View
    {
        $lstTaiKhoan = User::all();
        $lstTrangThaiDonHang = TrangThaiDonHang::all()->where('trang_thai', 1);
        if ($this->thongKe == 0) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1);
        }
        //Thống kê theo ngày tháng năm
        else if ($this->thongKe == 1) {
            $lstDonHang = DonHang::where('trang_thai', 1)->whereBetween('ngay_lap_dh', [$this->tu_ngay, $this->den_ngay])->get();
        }
        //Thống kê theo ngày hiện tại
        else if ($this->thongKe == 2) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('ngay_lap_dh', Carbon::today());
        }
        //Thống kê theo ngày hôm qua
        else if ($this->thongKe == 3) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('ngay_lap_dh', Carbon::yesterday());
        }
        //Thống kê theo tuần hiện tại
        else if ($this->thongKe == 4) {
            $this_week = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereBetween('ngay_lap_dh', $this_week);
        }
        //Thống kê theo tuần trước
        else if ($this->thongKe == 5) {
            $last_week = [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()];
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereBetween('ngay_lap_dh', $last_week);
        }
        //Thống kê theo tháng hiện tại
        else if ($this->thongKe == 6) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->format('m'));
        }
        //Thống kê theo tháng trước
        else if ($this->thongKe == 7) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereMonth('ngay_lap_dh', Carbon::now()->subMonth()->month);
        }
        //Thống kê theo năm hiện tại
        else if ($this->thongKe == 8) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->whereYear('ngay_lap_dh', Carbon::now()->year);
        }
        //Thống kê theo top các đơn hàng lớn nhất
        else if ($this->thongKe == 9) {
            if ($this->topDH == 1) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(5);
                })->get();
            } else if ($this->topDH == 2) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(10);
                })->get();
            } else if ($this->topDH == 3) {
                $lstDonHang = DB::table(function ($query) {
                    $query->selectRaw('*')
                        ->from('don_hangs')
                        ->orderBy('tong_tien', 'desc')
                        ->take(15);
                })->get();
            }
        }
        //Thống kê đơn hàng chưa nhận
        else if ($this->thongKe == 10) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('trang_thai_don_hang_id', 1);
        }
        //Thống kê đơn hàng đã nhận
        else if ($this->thongKe == 11) {
            $lstDonHang = DonHang::all()->where('trang_thai', 1)->where('trang_thai_don_hang_id', 2);
        }
        return view('component/thong-ke/thongke-xuatfileexcel', ['lstDonHang' => $lstDonHang, 'lstTaiKhoan' => $lstTaiKhoan, 'lstTrangThaiDonHang' => $lstTrangThaiDonHang, 'tu_ngay' => $this->tu_ngay, 'den_ngay' => $this->den_ngay]);
    }

    public function columnFormats(): array
    {
        return [
            // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // return [
        //     // Style the first row as bold text.
        //     2    => [
        //         'font' => ['bold' => true],
        //         'alignment' => [
        //             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        //         ],
        //         // 'fill' => [
        //         //     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        //         //     'rotation' => 90,
        //         //     'startColor' => [
        //         //         'argb' => '03b0d4',
        //         //     ],
        //         //     'endColor' => [
        //         //         'argb' => '03b0d4',
        //         //     ],
        //         // ],
        //     ],

        //     // // Styling a specific cell by coordinate.
        //     // 'B2' => ['font' => ['italic' => true]],

        //     // // Styling an entire column.
        //     // 'C'  => ['font' => ['size' => 16]],
        // ];
        //Mã màu
        $styleTH =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => '03b0d4',
            ],
            'endColor' => [
                'argb' => '03b0d4',
            ],
        ],);

        $styleTieuDeDanhSach =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'FFFF00',
            ],
            'endColor' => [
                'argb' => 'FFFF00',
            ],
        ],);

        $styleTieuDeTuNgay =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'FF9900',
            ],
            'endColor' => [
                'argb' => 'FF9900',
            ],
        ],);

        $styleTieuDeDenNgay =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => '3399FF',
            ],
            'endColor' => [
                'argb' => '3399FF',
            ],
        ],);

        $styleTieuDeNguoiLap =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'FFCC33',
            ],
            'endColor' => [
                'argb' => 'FFCC33',
            ],
        ],);

        $styleTieuDeNgayLap =  array('fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'FF3333',
            ],
            'endColor' => [
                'argb' => 'FF3333',
            ],
        ],);

        //Chỉnh font-family và font-size trong Font.php ($name)
        $sheet->getStyle('A1:T100')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // th
        $sheet->getStyle('9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // th
        $sheet->getStyle('14')->getFont()->setBold(true); // th
        $sheet->getStyle('B9')->getFont()->setSize(24); // Tiêu đề (Danh sách đơn hàng)   
        $sheet->getStyle('B9')->getFont()->setBold(true); // Tiêu đề (Danh sách đơn hàng)    

        $sheet->getStyle('A14:H14')->applyFromArray($styleTH);
        //Chỉnh khoảng cách của dòng
        // $sheet->getRowDimension('1')->setRowHeight(40);

        //Chỉnh khoảng cách của cột
        // $sheet->getColumnDimension('A')->setWidth(6);

        //Đặt tên
        $sheet->setCellValue('B9', 'Danh sách đơn hàng'); // Tiêu đề (Danh sách đơn hàng) 
        $sheet->setCellValue('C3', 'CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM'); // Tiêu đề Header
        $sheet->setCellValue('C4', 'Độc lập - Tự do - Hạnh phúc'); // Tiêu đề Header
        $sheet->getStyle('C3')->getFont()->setBold(true); // Tiêu đề Header
        $sheet->getStyle('C4')->getFont()->setBold(true); // Tiêu đề Header  
        $sheet->getStyle('C3')->getFont()->setSize(16); // Tiêu đề Header 
        $sheet->setCellValue('B11', 'Người lập báo cáo'); // Tiêu đề người lập báo cáo
        $sheet->setCellValue('B12', 'Ngày lập báo cáo'); // Tiêu đề ngày lập báo cáo  
        $sheet->getStyle('B11')->getFont()->setSize(14); // Tiêu đề Header 
        $sheet->getStyle('B12')->getFont()->setSize(14); // Tiêu đề Header  
        $sheet->getStyle('B11')->getFont()->setBold(true); // Tiêu đề người lập báo cáo
        $sheet->getStyle('B12')->getFont()->setBold(true); // Tiêu đề ngày lập báo cáo 
        if (Auth::user()->phan_loai_tai_khoan == 1) {
            $sheet->setCellValue('C11', 'Tổng quản lí'); // Dữ liệu người lập báo cáo
        } else
            $sheet->setCellValue('C11', Auth::user()->ho_ten); // Dữ liệu người lập báo cáo
        $sheet->setCellValue('C12', now()->format('d/m/Y')); // Dữ liệu ngày lập báo cáo  
        if ($this->thongKe == 1) {
            //Tiêu đề (Từ ngày)
            $sheet->setCellValue('E9', 'Từ ngày');
            $sheet->getStyle('E9')->getFont()->setBold(true);
            $sheet->getStyle('E9')->applyFromArray($styleTieuDeTuNgay);
            //Tiêu đề (Đến ngày)
            $sheet->setCellValue('G9', 'Đến ngày');
            $sheet->getStyle('G9')->getFont()->setBold(true);
            $sheet->getStyle('G9')->applyFromArray($styleTieuDeDenNgay);
            //Dữ liệu (Từ ngày)
            $sheet->setCellValue('F9', date('d/m/Y', strtotime($this->tu_ngay)));
            //Dữ liệu (Đến ngày)
            $sheet->setCellValue('H9', date('d/m/Y', strtotime($this->den_ngay)));
            //Tiêu đề (Danh sách đơn hàng)
            $sheet->setMergeCells(['B9:D9', 'C3:E3', 'C4:E4']);
            $sheet->getStyle('B9:D9')->applyFromArray($styleTieuDeDanhSach); // Màu
            //Tiêu đề người lập báo cáo
            $sheet->getStyle('B11')->applyFromArray($styleTieuDeNguoiLap); // Màu 
            //Tiêu đề người lập báo cáo
            $sheet->getStyle('B12')->applyFromArray($styleTieuDeNgayLap); // Màu
        } else {
            $sheet->setMergeCells(['B9:F9', 'C3:E3', 'C4:E4']); // Màu
            $sheet->getStyle('B9:F9')->applyFromArray($styleTieuDeDanhSach); // Màu
            //Tiêu đề người lập báo cáo
            $sheet->getStyle('B11')->applyFromArray($styleTieuDeNguoiLap); // Màu 
            //Tiêu đề người lập báo cáo
            $sheet->getStyle('B12')->applyFromArray($styleTieuDeNgayLap); // Màu
        }
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $event->sheet->getDelegate()->mergeCells('A1:H1');
    //             // $event->sheet->getDelegate()->getStyle('A2:Q2')
    //             //     ->getFill()
    //             //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    //             //     ->getStartColor()
    //             //     ->setARGB('CECECE');
    //         },
    //     ];
    // }

    public function drawings()
    {
        $drawingLogo = new Drawing();
        $drawingLogo->setName('Logo');
        $drawingLogo->setDescription('This is my logo');
        $drawingLogo->setPath(public_path('assets/img/icons/unicons/logo.png'));
        $drawingLogo->setHeight(90);
        $drawingLogo->setCoordinates('A2');
        $offsetX = 40; //pixels
        $drawingLogo->setOffsetX($offsetX); //pixels

        return $drawingLogo;
    }
    public function startCell(): string
    {
        return 'B2';
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\User;
use App\Models\MonAn;
use App\Models\HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDonHangRequest;
use App\Http\Requests\UpdateDonHangRequest;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstDonHang = DonHang::where('trang_thai', 1)->paginate(5);
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        // // dd($taiKhoan);
        // $i = 0;
        // $n = 5;
        // $temp1 = 0;
        // $temp = 0;
        // for ($i; $i < $n; $i++) {

        //     if ($donHang == $taiKhoan) {
        //         $temp1++;
        //     } else {
        //         $temp++;
        //     }
        //     // $temp++;
        // }
        // dd($temp1);
        // dd($lstTaiKhoan);
        return view('component/don-hang/donHang-index', compact('lstDonHang', 'lstTaiKhoan', 'request'));
    }

    public function index1(Request $request, $id, $user_id, $nguoi_giao_hang_id, $trang_thai_don_hang_id)
    {
        if ($id != 0) {
            $lstDonHang = DonHang::where('trang_thai', 1)
                ->where(function ($query) use ($id) {
                    $query->where('id', 'LIKE', '%' . $id . '%');
                })->paginate(5);
        } else if ($user_id != 0) {
            $lstDonHang = DonHang::where('trang_thai', 1)
                ->where(function ($query) use ($user_id) {
                    $query->where('user_id', 'LIKE', '%' . $user_id . '%');
                })->paginate(5);
        } else if ($nguoi_giao_hang_id != 0) {
            $lstDonHang = DonHang::where('trang_thai', 1)
                ->where(function ($query) use ($nguoi_giao_hang_id) {
                    $query->where('nguoi_giao_hang_id', 'LIKE', '%' . $nguoi_giao_hang_id . '%');
                })->paginate(5);
        } else if ($trang_thai_don_hang_id != 0) {
            $lstDonHang = DonHang::where('trang_thai', 1)
                ->where(function ($query) use ($trang_thai_don_hang_id) {
                    $query->where('trang_thai_don_hang_id', 'LIKE', '%' . $trang_thai_don_hang_id . '%');
                })->paginate(5);
        }

        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        return view('component/don-hang/donHang-index', compact('lstDonHang', 'lstTaiKhoan', 'request'));
    }

    public function searchDonHang(Request $request, User $taiKhoan)
    {
        $search = $request->search;
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        if ($search != null) {
            $lstDonHang = DonHang::where('trang_thai', 1)
                ->where(function ($query) use ($search) {
                    $query->where('ngay_lap_dh', 'LIKE', '%' . date('Y-m-d', strtotime($search)) . '%')
                        ->orWhere(function ($query) use ($search) {
                            $query->whereTime('ngay_lap_dh', $search);
                        })
                        ->orWhere(function ($query) use ($search) {
                            $query->whereMonth('ngay_lap_dh', $search);
                        })
                        ->orWhere(function ($query) use ($search) {
                            $query->whereYear('ngay_lap_dh', $search);
                        })
                        ->orWhere('tong_tien', 'LIKE', '%' . $search . '%')
                        ->orWhere('loai_thanh_toan', 'LIKE', '%' . $search . '%');
                })->paginate(5);
        } else if (($request->SapXep && $request->LocDonHang) && (($request->SapXep != 'macDinh') && ($request->LocDonHang != 'macDinh'))) {
            $sapXepDonHang = $request->SapXep;
            $locDonHang = $request->LocDonHang;
            switch ($sapXepDonHang) {
                case 'moiNhat':
                    $sapXep = 'ngay_lap_dh';
                    $desc_asc = 'desc';
                    break;
                case 'ngayLap':
                    $sapXep = 'ngay_lap_dh';
                    $desc_asc = 'asc';
                    break;
                case 'tongTien':
                    $sapXep = 'tong_tien';
                    $desc_asc = 'asc';
                    break;
                case 'diaChi':
                    $sapXep = 'dia_chi';
                    $desc_asc = 'asc';
                    break;
                case 'phuongThuc':
                    $sapXep = 'loai_thanh_toan';
                    $desc_asc = 'asc';
                    break;
            }
            switch ($locDonHang) {
                case 'tienMat':
                    $loc = 'Tiền mặt';
                    break;
                case 'the':
                    $loc = 'Thẻ';
                    break;
            }
            $lstDonHang = DonHang::where('trang_thai', 1)->where('loai_thanh_toan', $loc)->orderBy($sapXep, $desc_asc)->paginate(5);
        } else if ($request->SapXep) {
            $sapXepDonHang = $request->SapXep;
            // dd($sapXepDonHang);
            switch ($sapXepDonHang) {
                case 'moiNhat':
                    $lstDonHang = DonHang::where('trang_thai', 1)->orderBy('ngay_lap_dh', 'desc')->paginate(5);
                    break;
                case 'ngayLap':
                    $lstDonHang = DonHang::where('trang_thai', 1)->orderBy('ngay_lap_dh')->paginate(5);
                    break;
                case 'tongTien':
                    $lstDonHang = DonHang::where('trang_thai', 1)->orderBy('tong_tien')->paginate(5);
                    break;
                case 'nguoiGiaoHang':
                    dd($taiKhoan->id);
                    $lstDonHang = DonHang::where('trang_thai', 1)->where('nguoi_giao_hang_id', $taiKhoan->id)->orderBy('nguoi_giao_hang_id')->paginate(5);

                    dump($lstDonHang);
                    break;
                case 'diaChi':
                    $lstDonHang = DonHang::where('trang_thai', 1)->orderBy('dia_chi')->paginate(5);
                    break;
                case 'phuongThuc':
                    $lstDonHang = DonHang::where('trang_thai', 1)->orderBy('loai_thanh_toan')->paginate(5);
                    break;
                case 'macDinh':
                    $lstDonHang = DonHang::where('trang_thai', 1)->paginate(5);
                    break;
            }
        } else if ($request->LocDonHang) {

            $locDonHang = $request->LocDonHang;
            switch ($locDonHang) {
                case 'tienMat':
                    $lstDonHang = DonHang::where('trang_thai', 1)->where('loai_thanh_toan', 'Tiền mặt')->paginate(5);
                    break;
                case 'the':
                    $lstDonHang = DonHang::where('trang_thai', 1)->where('loai_thanh_toan', 'Thẻ')->paginate(5);
                    break;
                case 'macDinh':
                    $lstDonHang = DonHang::where('trang_thai', 1)->paginate(5);
                    break;
            }
        }
        // dd($lstDonHang);
        return view('component/don-hang/donHang-index', compact('lstDonHang', 'lstTaiKhoan', 'request'));
    }

    public function searchChiTietDonHang(Request $request)
    {
        $search = $request->search;
        $id = $request->id;
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstChiTietDonHang = ChiTietDonHang::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('don_gia', 'LIKE', '%' . $search . '%')
                ->orWhere('so_luong', 'LIKE', '%' . $search . '%')
                ->orWhere('thanh_tien', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('component/don-hang/donHang-show', compact('lstChiTietDonHang', 'lstMonAn', 'request', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonHangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lstChiTietDonHang = ChiTietDonHang::where('trang_thai', 1)->where('don_hang_id', $id)->paginate(5);
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        return view('component/don-hang/donhang-show', compact('lstChiTietDonHang', 'lstMonAn', 'lstHinhAnh', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function edit(DonHang $donHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonHangRequest  $request
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonHangRequest $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonHang  $donHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonHang $donHang)
    {
        //
    }

    public function xoa($id)
    {
        $donHang = DonHang::find($id);
        $donHang->trang_thai = 0;
        $donHang->save();
        return Redirect::route('donHang.index');
    }
}

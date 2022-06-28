<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\User;
use App\Models\MonAn;
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

    public function searchDonHang(Request $request)
    {
        $search = $request->search;
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        $lstDonHang = DonHang::where('trang_thai', 1)
            ->where(function ($query) use ($search) {
                $query->where('ngay_lap_dh', 'LIKE', '%' . $search . '%')
                    ->orWhere('tong_tien', 'LIKE', '%' . $search . '%')
                    ->orWhere('loai_thanh_toan', 'LIKE', '%' . $search . '%');
            })
            ->paginate(5);
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
        return view('component/don-hang/donhang-show', compact('lstChiTietDonHang', 'lstMonAn', 'id'));
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
}

<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\User;
use App\Models\MonAn;
use App\Http\Requests\StoreDonHangRequest;
use App\Http\Requests\UpdateDonHangRequest;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstDonHang = DonHang::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all();
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
        return view('component/don-hang/donHang-index', compact('lstDonHang', 'lstTaiKhoan'));
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
        $lstChiTietDonHang = ChiTietDonHang::all()->where('trang_thai', 1)->where('don_hang_id', $id);
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        return view('component/don-hang/donhang-show', compact('lstChiTietDonHang', 'lstMonAn'));
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

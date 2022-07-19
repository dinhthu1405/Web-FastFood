<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Http\Requests\StoreChiTietDonHangRequest;
use App\Http\Requests\UpdateChiTietDonHangRequest;

class ChiTietDonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreChiTietDonHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChiTietDonHangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $donHang = DonHang::select('id')->where('trang_thai', 1)->get();

        // if ($donHang == $chiTietDonHang) {
        //     return view('component/chi-tiet-don-hang/chitietdonhang-show', compact('chiTietDonHang'));
        // }
        return view('component/chi-tiet-don-hang/chitietdonhang-show', compact('donHang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function edit(ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChiTietDonHangRequest  $request
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChiTietDonHangRequest $request, ChiTietDonHang $chiTietDonHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChiTietDonHang  $chiTietDonHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChiTietDonHang $chiTietDonHang)
    {
        //
    }
}

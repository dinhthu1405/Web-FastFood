<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use App\Models\LoaiGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreMaGiamGiaRequest;
use App\Http\Requests\UpdateMaGiamGiaRequest;

class MaGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstMaGiamGia = MaGiamGia::all()->where('trang_thai', 1);
        return view('component/ma-giam-gia/magiamgia-show', compact('lstMaGiamGia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lstLoaiGiamGia = LoaiGiamGia::all()->where('trang_thai', 1);
        return view('component/ma-giam-gia/magiamgia-create', compact('lstLoaiGiamGia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMaGiamGiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenMaGiamGia' => 'required|unique:ma_giam_gias,ten_ma',
                'LoaiGiamGia' => 'required',
            ],
            [
                'TenMaGiamGia.required' => 'Bạn chưa nhập tên mã giảm giá',
                'TenMaGiamGia.unique' => 'Tên mã giảm giá đã tồn tại',
                'LoaiGiamGia.required' => 'Bạn chưa chọn loại giảm giá',
            ]
        );
        $maGiamGia = new MaGiamGia();
        $maGiamGia->fill([
            'ten_ma' => $request->input('TenMaGiamGia'),
            'loai_giam_gia_id' => $request->input('LoaiGiamGia'),
        ]);

        $maGiamGia->save();
        return redirect()->route('maGiamGia.index')->with('success', 'Thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaGiamGia  $maGiamGia
     * @return \Illuminate\Http\Response
     */
    public function show(MaGiamGia $maGiamGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaGiamGia  $maGiamGia
     * @return \Illuminate\Http\Response
     */
    public function edit(MaGiamGia $maGiamGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaGiamGiaRequest  $request
     * @param  \App\Models\MaGiamGia  $maGiamGia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaGiamGiaRequest $request, MaGiamGia $maGiamGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaGiamGia  $maGiamGia
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaGiamGia $maGiamGia)
    {
        //
    }
}

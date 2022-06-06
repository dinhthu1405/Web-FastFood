<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\User;
use App\Models\MonAN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreBinhLuanRequest;
use App\Http\Requests\UpdateBinhLuanRequest;

class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstBinhLuan = BinhLuan::all();
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', 1);
        return view('component.binh-luan.binhluan-show', compact('lstBinhLuan', 'lstMonAn', 'lstTaiKhoan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', '1');
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        return view('component/binh-luan/binhluan-create', compact('lstTaiKhoan', 'lstMonAn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBinhLuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'NoiDung' => 'required',
            ],
            [
                'NoiDung.required' => 'Bạn chưa nhập nội dung bình luận',
            ]
        );

        if ($request->input('TaiKhoan') != "-- Chọn tài khoản --") {
            $taiKhoan =  $request->input('TaiKhoan');
        } else {
            $taiKhoan = null;
        }
        if ($request->input('MonAn') != "-- Chọn món ăn --") {
            $monAn =  $request->input('MonAn');
        } else {
            $monAn = null;
        }

        $binhLuan = new BinhLuan();
        $binhLuan->fill([
            'noi_dung' => $request->input('NoiDung'),
            'thoi_gian' => $request->input('ThoiGian'),
            'user_id' => $taiKhoan,
            'mon_an_id' => $monAn,
        ]);
        if ($taiKhoan == null && $monAn == null) {
            return Redirect::back()->with('error', 'Bạn chưa chọn tài khoản và món ăn');
        } else if ($taiKhoan == null) {
            return Redirect::back()->with('error', 'Bạn chưa chọn tài khoản');
        } else if ($monAn == null) {
            return Redirect::back()->with('error', 'Bạn chưa chọn món ăn');
        } else {
            $binhLuan->save();
            return Redirect::route('binhLuan.index')->with('success', 'Thêm bình luận thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function show(BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function edit(BinhLuan $binhLuan)
    {
        //
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', '1');
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        // dd(compact('binhLuan', 'lstTaiKhoan', 'lstMonAn'));
        return view('component/binh-luan/binhluan-edit', compact('binhLuan', 'lstTaiKhoan', 'lstMonAn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBinhLuanRequest  $request
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BinhLuan $binhLuan)
    {
        //
        $binhLuan->fill([
            'noi_dung' => $request->input('NoiDung'),
            'thoi_gian' => $request->input('ThoiGian'),
            'user_id' => $request->input('TaiKhoan'),
            'mon_an_id' => $request->input('MonAn'),
        ]);
        $binhLuan->save();
        return Redirect::route('binhLuan.index')->with('success', 'Sửa bình luận thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BinhLuan $binhLuan)
    {
        //
    }

    public function xoa($id)
    {
        $binhLuan = BinhLuan::find($id);
        if ($binhLuan->trang_thai == 0) {
            $binhLuan->trang_thai = 1;
            $binhLuan->save();
            return Redirect::route('binhLuan.index');
        } else {
            $binhLuan->trang_thai = 0;
            $binhLuan->save();
            return Redirect::route('binhLuan.index');
        }
    }
}

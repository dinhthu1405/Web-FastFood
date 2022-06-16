<?php

namespace App\Http\Controllers;

use App\Models\TrangThaiDonHang;
use App\Http\Requests\StoreTrangThaiDonHangRequest;
use App\Http\Requests\UpdateTrangThaiDonHangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TrangThaiDonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstTrangThaiDonHang = TrangThaiDonhang::where('trang_thai', 1)->paginate(5);
        return view('component.trang-thai-don-hang.trangthaidonhang-show', compact('lstTrangThaiDonHang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component.trang-thai-don-hang.trangthaidonhang-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrangThaiDonHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenTrangThaiDonHang' => 'required|unique:trang_thai_don_hangs,ten_trang_thai',
            ],
            [
                'TenTrangThaiDonHang.required' => 'Bạn chưa nhập tên trạng thái đơn hàng',
                'TenTrangThaiDonHang.unique' => 'Tên trạng thái đơn hàng đã tồn tại',
            ]
        );
        $trangThaiDonHang = new TrangThaiDonHang();
        $trangThaiDonHang->fill([
            'ten_trang_thai' => $request->input('TenTrangThaiDonHang'),
        ]);
        $trangThaiDonHang->save();
        return Redirect::route('trangThaiDonHang.index')->with('success', 'Thêm trạng thái đơn hàng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrangThaiDonHang  $trangThaiDonHang
     * @return \Illuminate\Http\Response
     */
    public function show(TrangThaiDonHang $trangThaiDonHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrangThaiDonHang  $trangThaiDonHang
     * @return \Illuminate\Http\Response
     */
    public function edit(TrangThaiDonHang $trangThaiDonHang)
    {
        //
        return view('component/trang-thai-don-hang/trangthaidonhang-edit', compact('trangThaiDonHang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrangThaiDonHangRequest  $request
     * @param  \App\Models\TrangThaiDonHang  $trangThaiDonHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrangThaiDonHang $trangThaiDonHang)
    {
        //
        $this->validate(
            $request,
            [
                'TenTrangThaiDonHang' => 'required|unique:trang_thai_don_hangs,ten_trang_thai',
            ],
            [
                'TenTrangThaiDonHang.required' => 'Bạn chưa nhập tên trạng thái đơn hàng',
                'TenTrangThaiDonHang.unique' => 'Tên trạng thái đơn hàng đã tồn tại',
            ]
        );
        $trangThaiDonHang->fill([
            'ten_trang_thai' => $request->input('TenTrangThaiDonHang'),
        ]);
        $trangThaiDonHang->save();
        return Redirect::route('trangThaiDonHang.index')->with('success', 'Sửa trạng thái đơn hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrangThaiDonHang  $trangThaiDonHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrangThaiDonHang $trangThaiDonHang)
    {
        //
    }

    public function xoa($id)
    {
        $trangThaiDonHang = TrangThaiDonHang::find($id);
        $trangThaiDonHang->trang_thai = 0;
        $trangThaiDonHang->save();
        $trangThaiDonHang->donHangs()->update(['don_hangs.trang_thai' => 0]);
        return Redirect::route('trangThaiDonHang.index');
    }
}

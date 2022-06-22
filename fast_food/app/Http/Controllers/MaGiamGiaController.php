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
    public function index(Request $request)
    {
        //
        $lstMaGiamGia = MaGiamGia::paginate(5);
        return view('component/ma-giam-gia/magiamgia-show', compact('lstMaGiamGia', 'request'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $lstMaGiamGia = MaGiamGia::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('ten_ma', 'LIKE', '%' . $search . '%')
            ->orWhere('so_luong', 'LIKE', '%' . $search . '%')
            ->orWhere('ngay_bat_dau', 'LIKE', '%' . $search . '%')
            ->orWhere('ngay_ket_thuc', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('component/ma-giam-gia/magiamgia-show', compact('lstMaGiamGia', 'request'));
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
                'TenMaGiamGia' => 'required',
                'LoaiGiamGia' => 'required',
                'SoLuong' => 'required',
                'NgayBatDau' => 'required',
                'NgayKetThuc' => 'required',
            ],
            [
                'TenMaGiamGia.required' => 'Bạn chưa nhập tên mã giảm giá',
                'LoaiGiamGia.required' => 'Bạn chưa chọn loại giảm giá',
                'SoLuong.required' => 'Bạn chưa nhập số lượng',
                'NgayBatDau.required' => 'Bạn chưa nhập ngày bắt đầu',
                'NgayKetThuc.required' => 'Bạn chưa nhập ngày kết thúc',
            ]
        );
        $maGiamGia = new MaGiamGia();
        $maGiamGia->fill([
            'ten_ma' => $request->input('TenMaGiamGia'),
            'so_luong' => $request->input('SoLuong'),
            'ngay_bat_dau' => $request->input('NgayBatDau'),
            'ngay_ket_thuc' => $request->input('NgayKetThuc'),
            'loai_giam_gia_id' => $request->input('LoaiGiamGia'),
        ]);

        $ktMaGiamGia = MaGiamGia::all()->where('ten_ma', $request->input('TenMaGiamGia'))->where('trang_thai', 1)->where('loai_giam_gia_id', $request->input('LoaiGiamGia'))->first();
        // dd($maGiamGia);
        if ($ktMaGiamGia) {
            return Redirect::back()->with('error', 'Tên mã giảm giá đã tồn tại');
        } else if ($request->input('NgayBatDau') > $request->input('NgayKetThuc')) {
            return Redirect::back()->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
        } else {
            $maGiamGia->save();
            return Redirect::route('maGiamGia.index')->with('success', 'Thêm mã giảm giá thành công');
        }
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
    public function edit(MaGiamGia $maGiamGium)
    {
        //
        $lstLoaiGiamGia = LoaiGiamGia::all()->where('trang_thai', 1);
        return view('component.ma-giam-gia.magiamgia-edit', compact('maGiamGium', 'lstLoaiGiamGia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaGiamGiaRequest  $request
     * @param  \App\Models\MaGiamGia  $maGiamGia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaGiamGia $maGiamGium)
    {
        //
        $this->validate(
            $request,
            [
                'TenMaGiamGia' => 'required',
                'LoaiGiamGia' => 'required',
                'SoLuong' => 'required',
                'NgayBatDau' => 'required',
                'NgayKetThuc' => 'required',
            ],
            [
                'TenMaGiamGia.required' => 'Bạn chưa nhập tên mã giảm giá',
                'LoaiGiamGia.required' => 'Bạn chưa chọn loại giảm giá',
                'SoLuong.required' => 'Bạn chưa nhập số lượng',
                'NgayBatDau.required' => 'Bạn chưa nhập ngày bắt đầu',
                'NgayKetThuc.required' => 'Bạn chưa nhập ngày kết thúc',
            ]
        );
        $maGiamGium->fill([
            'ten_ma' => $request->input('TenMaGiamGia'),
            'so_luong' => $request->input('SoLuong'),
            'ngay_bat_dau' => $request->input('NgayBatDau'),
            'ngay_ket_thuc' => $request->input('NgayKetThuc'),
            'loai_giam_gia_id' => $request->input('LoaiGiamGia'),
        ]);

        $ktMaGiamGia = MaGiamGia::all()->where('ten_ma', $request->input('TenMaGiamGia'))->where('trang_thai', 1)->where('loai_giam_gia_id', $request->input('LoaiGiamGia'))->first();
        if ($ktMaGiamGia) {
            return Redirect::back()->with('error', 'Tên mã giảm giá đã tồn tại');
        } else if ($request->input('NgayBatDau') > $request->input('NgayKetThuc')) {
            return Redirect::back()->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
        } else {
            $maGiamGium->save();
            return Redirect::route('maGiamGia.index')->with('success', 'Sửa mã giảm giá thành công');
        }
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

    public function xoa($id)
    {
        $maGiamGia = MaGiamGia::find($id);
        if ($maGiamGia->trang_thai == 0) {
            $maGiamGia->trang_thai = 1;
            $maGiamGia->save();
            return Redirect::route('maGiamGia.index');
        } else {
            $maGiamGia->trang_thai = 0;
            $maGiamGia->save();
            return Redirect::route('maGiamGia.index');
        }
    }
}

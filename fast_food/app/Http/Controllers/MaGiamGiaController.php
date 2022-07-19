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
        // MaGiamGia::withTrashed()->find(1)->restore();
        $lstMaGiamGia = MaGiamGia::paginate(5);
        $lstLoaiGiamGia = LoaiGiamGia::all()->where('trang_thai', 1);
        // $lstMaGiamGia->restore();
        return view('component/ma-giam-gia/magiamgia-show', compact('lstMaGiamGia', 'lstLoaiGiamGia', 'request'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $lstMaGiamGia = MaGiamGia::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('ten_ma', 'LIKE', '%' . $search . '%')
                ->orWhere('so_luong', 'LIKE', '%' . $search . '%')
                ->orWhere('ngay_bat_dau', 'LIKE', '%' . date('Y-m-d', strtotime($search)) . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->whereTime('ngay_bat_dau', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereMonth('ngay_bat_dau', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereYear('ngay_bat_dau', $search);
                })
                ->orWhere('ngay_ket_thuc', 'LIKE', '%' . date('Y-m-d', strtotime($search)) . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->whereTime('ngay_ket_thuc', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereMonth('ngay_ket_thuc', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereYear('ngay_ket_thuc', $search);
                });
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
                'TienGiam' => 'required',
                'LoaiGiamGia' => 'required',
                'SoLuong' => 'required',
                'NgayBatDau' => 'required',
                'NgayKetThuc' => 'required',
            ],
            [
                'TenMaGiamGia.required' => 'Bạn chưa nhập tên mã giảm giá',
                'TienGiam.required' => 'Bạn chưa chọn % giảm',
                'LoaiGiamGia.required' => 'Bạn chưa chọn loại giảm giá',
                'SoLuong.required' => 'Bạn chưa nhập số lượng',
                'NgayBatDau.required' => 'Bạn chưa chọn ngày bắt đầu',
                'NgayKetThuc.required' => 'Bạn chưa chọn ngày kết thúc',
            ]
        );
        $phan_tram_giam = '0.0';
        switch ($request->input('TienGiam')) {
            case (1):
                $phan_tram_giam = '0.1';
                break;
            case (2):
                $phan_tram_giam = '0.2';
                break;
            case (3):
                $phan_tram_giam = '0.3';
                break;
            case (4):
                $phan_tram_giam = '0.4';
                break;
            case (5):
                $phan_tram_giam = '0.5';
                break;
            case (6):
                $phan_tram_giam = '0.6';
                break;
            case (7):
                $phan_tram_giam = '0.7';
                break;
            case (8):
                $phan_tram_giam = '0.8';
                break;
            case (9):
                $phan_tram_giam = '0.9';
                break;
            case (10):
                $phan_tram_giam = '1';
                break;
        }
        // dd($phan_tram_giam);
        $maGiamGia = new MaGiamGia();
        $maGiamGia->fill([
            'ten_ma' => $request->input('TenMaGiamGia'),
            'tien_giam' => $phan_tram_giam,
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
                'LoaiGiamGia' => 'required',
                'SoLuong' => 'required',
                'NgayBatDau' => 'required',
                'NgayKetThuc' => 'required',
            ],
            [
                'LoaiGiamGia.required' => 'Bạn chưa chọn loại giảm giá',
                'SoLuong.required' => 'Bạn chưa nhập số lượng',
                'NgayBatDau.required' => 'Bạn chưa chọn ngày bắt đầu',
                'NgayKetThuc.required' => 'Bạn chưa chọn ngày kết thúc',
            ]
        );
        $phan_tram_giam = '0.0';
        switch ($request->input('TienGiam')) {
            case (1):
                $phan_tram_giam = '0.1';
                break;
            case (2):
                $phan_tram_giam = '0.2';
                break;
            case (3):
                $phan_tram_giam = '0.3';
                break;
            case (4):
                $phan_tram_giam = '0.4';
                break;
            case (5):
                $phan_tram_giam = '0.5';
                break;
            case (6):
                $phan_tram_giam = '0.6';
                break;
            case (7):
                $phan_tram_giam = '0.7';
                break;
            case (8):
                $phan_tram_giam = '0.8';
                break;
            case (9):
                $phan_tram_giam = '0.9';
                break;
            case (10):
                $phan_tram_giam = '1';
                break;
        }
        $maGiamGium->fill([
            'tien_giam' => $phan_tram_giam,
            'so_luong' => $request->input('SoLuong'),
            'ngay_bat_dau' => $request->input('NgayBatDau'),
            'ngay_ket_thuc' => $request->input('NgayKetThuc'),
            'loai_giam_gia_id' => $request->input('LoaiGiamGia'),
        ]);

        // $ktMaGiamGia = MaGiamGia::all()->where('ten_ma', $request->input('TenMaGiamGia'))->where('trang_thai', 1)->where('loai_giam_gia_id', $request->input('LoaiGiamGia'))->first();
        // if ($ktMaGiamGia) {
        //     return Redirect::back()->with('error', 'Tên mã giảm giá đã tồn tại');
        // } else 
        if ($request->input('NgayBatDau') > $request->input('NgayKetThuc')) {
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

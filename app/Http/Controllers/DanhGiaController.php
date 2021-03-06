<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\User;
use App\Models\MonAn;
use App\Models\DiaDiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDanhGiaRequest;
use App\Http\Requests\UpdateDanhGiaRequest;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstDanhGia = DanhGia::paginate(5);
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', 1);
        $lstDiaDiem = DiaDiem::all()->where('trang_thai', 1);
        return view('component/danh-gia/danhgia-show', compact('lstDanhGia', 'lstMonAn', 'lstTaiKhoan', 'lstDiaDiem', 'request'));
    }

    public function index1($id)
    {
        //
        $danhGia = DanhGia::find($id);
        // dd($danhGia);
        $danhGia->duyet = 1;
        $danhGia->save();
        return Redirect::route('danhGia.index');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $lstDanhGia = DanhGia::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('danh_gia_sao', 'LIKE', '%' . $search . '%')
                ->orWhere('noi_dung', 'LIKE', '%' . $search . '%')
                // ->orWhere('duyet', 'LIKE', '%' . $search . '%')
                ->orWhere('thoi_gian', 'LIKE', '%' . date('Y-m-d', strtotime($search)) . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->whereTime('thoi_gian', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereMonth('thoi_gian', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereYear('thoi_gian', $search);
                });
        })->paginate(5);
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', 1);
        $lstDiaDiem = DiaDiem::all()->where('trang_thai', 1);
        return view('component/danh-gia/danhgia-show', compact('lstDanhGia', 'lstMonAn', 'lstTaiKhoan', 'lstDiaDiem', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', '1');
        $lstDiaDiem = DiaDiem::all()->where('trang_thai', 1);

        return view('component/danh-gia/danhgia-create', compact('lstMonAn', 'lstTaiKhoan', 'lstDiaDiem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDanhGiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'DanhGiaSao' => 'required',
            ],
            [
                'DanhGiaSao.required' => 'B???n ch??a ch???n ????nh gi??',
            ]
        );

        if ($request->input('TaiKhoan') != "-- Ch???n t??i kho???n --") {
            $taiKhoan =  $request->input('TaiKhoan');
        } else {
            $taiKhoan = null;
        }
        if ($request->input('MonAn') != "-- Ch???n m??n ??n --") {
            $monAn =  $request->input('MonAn');
        } else {
            $monAn = null;
        }
        if ($request->input('DiaDiem') != "-- Ch???n ?????a ??i???m --") {
            $diaDiem =  $request->input('DiaDiem');
        } else {
            $diaDiem = null;
        }

        $danhGia = new DanhGia();
        $danhGia->fill([
            'danh_gia_sao' => $request->input('DanhGiaSao'),
            'noi_dung' => $request->input('NoiDung'),
            // 'ngay_danh_gia' => date('Y-m-d H:i:s'),

            'user_id' => $taiKhoan,
            'mon_an_id' => $monAn,
            'dia_diem_id' => $diaDiem,
        ]);
        // $danhGia->save();
        // dd($request->input('DanhGiaSao') == "-- Ch???n sao --");
        if ($request->input('DanhGiaSao') ==  "-- Ch???n sao --") {
            return Redirect::back()->with('error', 'B???n ph???i ch???n sao ????? ????nh gi??');
        } else if ($taiKhoan == null && $monAn == null && $diaDiem == null) {
            return Redirect::back()->with('error', 'B???n ph???i ch???n 1 trong 3 th??ng tin (t??i kho???n; m??n ??n; ?????a ??i???m)');
        } else {
            $danhGia->save();
            return Redirect::route('danhGia.index')->with('success', 'Th??m ????nh gi?? th??nh c??ng');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function show(DanhGia $danhGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function edit(DanhGia $danhGium)
    {
        //
        $lstMonAn = MonAn::all()->where('trang_thai', 1);
        $lstTaiKhoan = User::all()->where('phan_loai_tai_khoan', '!=', '1');

        $lstDiaDiem = DiaDiem::all()->where('trang_thai', 1);
        return view('component/danh-gia/danhgia-edit', compact('danhGium', 'lstMonAn', 'lstTaiKhoan', 'lstDiaDiem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDanhGiaRequest  $request
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDanhGiaRequest $request, DanhGia $danhGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function destroy(DanhGia $danhGia)
    {
        //
    }

    public function xoa($id)
    {
        $danhGia = DanhGia::find($id);
        if ($danhGia->trang_thai == 0) {
            $danhGia->trang_thai = 1;
            $danhGia->save();
            return Redirect::route('danhGia.index');
        } else {
            $danhGia->trang_thai = 0;
            $danhGia->save();
            return Redirect::route('danhGia.index');
        }
    }
}

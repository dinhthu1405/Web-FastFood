<?php

namespace App\Http\Controllers;

use App\models\LoaiGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LoaiGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstLoaiGiamGia = LoaiGiamGia::where('trang_thai', 1)->paginate(5);
        return view('component/loai-ma-giam-gia/loaimagiamgia-show', compact('lstLoaiGiamGia', 'request'));
    }

    public function index1(Request $request, $loai_giam_gia_id)
    {
        //
        $lstLoaiGiamGia = LoaiGiamGia::where('trang_thai', 1)->where('id', $loai_giam_gia_id)->paginate(5);
        return view('component/loai-ma-giam-gia/loaimagiamgia-show', compact('lstLoaiGiamGia', 'request'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $lstLoaiGiamGia = LoaiGiamGia::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('ten_loai_giam_gia', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('component/loai-ma-giam-gia/loaimagiamgia-show', compact('lstLoaiGiamGia', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component/loai-ma-giam-gia/loaimagiamgia-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'loai_giam_gia' => 'required'
            ],
            [
                'loai_giam_gia.required' => 'Bạn chưa nhập tên loại giảm giá',
            ]
        );
        if ($validator->fails()) {
            // dd($validator);
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $loaiGiamGia = new LoaiGiamGia();
            $loaiGiamGia->ten_loai_giam_gia = $request->input('loai_giam_gia');
            $ktLoaiMaGiamGia = LoaiGiamGia::all()->where('ten_loai_giam_gia', $request->input('loai_giam_gia'))->where('trang_thai', 1)->first();
            if ($ktLoaiMaGiamGia) {
                return response()->json(['status' => 401, 'errors' => 'Tên loại giảm giá đã tồn tại']);
            } else {
                $loaiGiamGia->save();
                return response()->json(['status' => 200, 'success' => 'Thêm thành công']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiGiamGia $loaiGiamGium)
    {
        //
        return view('component/loai-ma-giam-gia/loaimagiamgia-edit', compact('loaiGiamGium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiGiamGia $loaiGiamGium)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoaiMaGiamGia' => 'required|unique:loai_giam_gias,ten_loai_giam_gia',
            ],
            [
                'TenLoaiMaGiamGia.required' => 'Bạn chưa nhập tên loại mã giảm giá',
                'TenLoaiMaGiamGia.unique' => 'Tên mã giảm giá đã tồn tại',
            ]
        );
        $loaiGiamGium->fill([
            'ten_loai_giam_gia' => $request->input('TenLoaiMaGiamGia'),
        ]);
        $loaiGiamGium->save();
        return Redirect::route('loaiGiamGia.index')->with('success', 'Chỉnh sửa loại giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function xoa($id)
    {
        $ngay_hien_tai = Carbon::now()->toDateTimeString();
        $loaiGiamGia = loaiGiamGia::find($id);
        $loaiGiamGia->trang_thai = 0;
        $loaiGiamGia->save();
        $loaiGiamGia->maGiamGias()->update(['ma_giam_gias.deleted_at' => $ngay_hien_tai]);
        // $loaiGiamGia->maGiamGias()->update(['ma_giam_gias.trang_thai' => 0]);
        return Redirect::route('loaiGiamGia.index');
    }

    public function xoaNhieu(Request $request)
    {
        $id = $request->get('ids');
        if ($id == null) {
            return Redirect::route('loaiGiamGia.index');
        } else {
            loaiGiamGia::find($id)->each(function ($loaiGiamGia, $key) {
                $ngay_hien_tai = Carbon::now()->toDateTimeString();
                $loaiGiamGia->trang_thai = 0;
                $loaiGiamGia->save();
                $loaiGiamGia->maGiamGias()->update(['ma_giam_gias.deleted_at' => $ngay_hien_tai]);
                // $loaiGiamGia->maGiamGias()->update(['ma_giam_gias.trang_thai' => 0]);
            });
            return Redirect::route('loaiGiamGia.index');
        }
    }
}

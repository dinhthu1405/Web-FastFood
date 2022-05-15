<?php

namespace App\Http\Controllers;

use App\Models\LoaiMonAn;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLoaiMonAnRequest;
use App\Http\Requests\UpdateLoaiMonAnRequest;

class LoaiMonAnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstLoaiMonAn = LoaiMonAn::all();
        return view('component/loai-mon-an/loaimonan-show', compact('lstLoaiMonAn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component/loai-mon-an/loaimonan-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoaiMonAnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoaiMonAnRequest $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoai' => 'required',
            ],
            [
                'TenLoai.required' => 'Bạn chưa nhập tên loại món ăn',
            ]
        );
        $loaiMonAn = new LoaiMonAn();
        $loaiMonAn->fill([
            'ten_loai' => $request->input('TenLoai'),
        ]);
        $ktLoaiMonAn = LoaiMonAn::where('ten_loai', $request->input('TenLoai'))->first();
        if ($ktLoaiMonAn) {
            return Redirect::back()->with('error', 'Tên loại món ăn đã tồn tại');
        } else {
            $loaiMonAn->save();
            return Redirect::route('loaiMonAn.index')->with('success', 'Thêm loại món ăn thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoaiMonAn  $loaiMonAn
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiMonAn $loaiMonAn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoaiMonAn  $loaiMonAn
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiMonAn $loaiMonAn)
    {
        //
        return view('component/loai-mon-an/loaimonan-edit', compact('loaiMonAn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoaiMonAnRequest  $request
     * @param  \App\Models\LoaiMonAn  $loaiMonAn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoaiMonAnRequest $request, LoaiMonAn $loaiMonAn)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoai' => 'required',
            ],
            [
                'TenLoai.required' => 'Bạn chưa nhập tên loại món ăn',
            ]
        );
        $loaiMonAn->fill([
            'ten_loai' => $request->input('TenLoai'),
        ]);
        $ktLoaiMonAn = LoaiMonAn::where('ten_loai', $request->input('TenLoai'))->first();
        if ($ktLoaiMonAn) {
            return Redirect::back()->with('error', 'Tên loại món ăn đã tồn tại');
        } else {
            $loaiMonAn->save();
            return Redirect::route('loaiMonAn.index')->with('success', 'Chỉnh sửa loại món ăn thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoaiMonAn  $loaiMonAn
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoaiMonAn $loaiMonAn)
    {
        //
    }
}

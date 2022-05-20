<?php

namespace App\Http\Controllers;

use App\Models\LoaiMonAn;
use Illuminate\Http\Request;
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
        $lstLoaiMonAn = LoaiMonAn::all()->where('trang_thai', 1);
        
        return view('component/loai-mon-an/loaimonan-show', compact('lstLoaiMonAn'));
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        // Search in the title and body columns from the posts table
        $lstLoaiMonAn = LoaiMonAn::where('ten_loai', 'LIKE', '%' . $search . '%')->get();
        // return $lstDiaDanh;
        return view('component/loai-mon-an/loaimonan-show', ['lstLoaiMonAn' => $lstLoaiMonAn]);
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
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoai' => 'required|unique:loai_mon_ans,ten_loai',
            ],
            [
                'TenLoai.required' => 'Bạn chưa nhập tên loại món ăn',
                'TenLoai.unique' => 'Tên loại món ăn đã tồn tại',
            ]
        );
        $loaiMonAn = new LoaiMonAn();
        $loaiMonAn->fill([
            'ten_loai' => $request->input('TenLoai'),
        ]);
        $loaiMonAn->save();
        return Redirect::route('loaiMonAn.index')->with('success', 'Thêm loại món ăn thành công');
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
    public function update(Request $request, LoaiMonAn $loaiMonAn)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoai' => 'required|unique:loai_mon_ans,ten_loai',
            ],
            [
                'TenLoai.required' => 'Bạn chưa nhập tên loại món ăn',
                'TenLoai.unique' => 'Tên loại món ăn đã tồn tại',
            ]
        );
        $loaiMonAn->fill([
            'ten_loai' => $request->input('TenLoai'),
        ]);
        $loaiMonAn->save();
        return Redirect::route('loaiMonAn.index')->with('success', 'Chỉnh sửa loại món ăn thành công');
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

    public function xoa($id)
    {
        $loaiMonAn = LoaiMonAn::find($id);
        $loaiMonAn->trang_thai = 0;
        $loaiMonAn->save();
        $loaiMonAn->monAns()->update(['mon_ans.trang_thai' => 0]);
        return Redirect::route('loaiMonAn.index');
    }
}

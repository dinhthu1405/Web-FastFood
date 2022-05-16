<?php

namespace App\Http\Controllers;

use App\Models\DiaDiem;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDiaDiemRequest;
use App\Http\Requests\UpdateDiaDiemRequest;

class DiaDiemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstDiaDiem = DiaDiem::all();
        return view('component/dia-diem/diadiem-show', compact('lstDiaDiem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component/dia-diem/diadiem-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiaDiemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiaDiemRequest $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenDiaDiem' => 'required',
            ],
            [
                'TenDiaDiem.required' => 'Bạn chưa nhập tên địa điểm',
                // 'TenDiaDiem.unique' => 'Tên địa điểm đã tồn tại',
            ]
        );
        $diaDiem = new DiaDiem();
        $diaDiem->fill([
            'ten_dia_diem' => $request->input('TenDiaDiem'),
            'thoi_gian_mo' => $request->input('ThoiGianMo'),
            'thoi_gian_dong' => $request->input('ThoiGianDong'),
        ]);
        // dd($diaDiem);
        $ktDiaDiem = DiaDiem::where('ten_dia_diem', $request->input('TenDiaDiem'))->first();
        // return ($ktDiaDanh);
        if ($ktDiaDiem) {
            return Redirect::back()->with('error', 'Tên địa điểm đã tồn tại');
        } else {
            $diaDiem->save(); //lưu xong mới có mã địa điểm
        }
        $diaDiem->save(); //lưu xong mới có mã địa điểm

        return Redirect::route('diaDiem.index')->with('success', 'Thêm địa điểm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiaDiem  $diaDiem
     * @return \Illuminate\Http\Response
     */
    public function show(DiaDiem $diaDiem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiaDiem  $diaDiem
     * @return \Illuminate\Http\Response
     */
    public function edit(DiaDiem $diaDiem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiaDiemRequest  $request
     * @param  \App\Models\DiaDiem  $diaDiem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiaDiemRequest $request, DiaDiem $diaDiem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiaDiem  $diaDiem
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiaDiem $diaDiem)
    {
        //
    }
}

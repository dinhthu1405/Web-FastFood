<?php

namespace App\Http\Controllers;

use App\Models\DiaDiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDiaDiemRequest;
use App\Http\Requests\UpdateDiaDiemRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

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
        $lstDiaDiem = DiaDiem::all()->where('trang_thai', 1);
        return view('component/dia-diem/diadiem-show', compact('lstDiaDiem'));
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        // Search in the title and body columns from the posts table
        $lstDiaDiem = DiaDiem::where('ten_dia_diem', 'LIKE', '%' . $search . '%')->get();

        return view('component/dia-diem/diadiem-show', ['lstDiaDiem' => $lstDiaDiem]);
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
    public function store(Request $request)
    {
        //

        // $weekMap = [
        //     0 => 'Chủ nhật',
        //     1 => 'Thứ hai',
        //     2 => 'Thứ ba',
        //     3 => 'Thứ tư',
        //     4 => 'Thứ năm',
        //     5 => 'Thứ sáu',
        //     6 => 'Thứ bảy',
        // ];
        // $carbon = Carbon::now();
        // dd($weekMap[$carbon->dayOfWeek]);
        // $this->validate(
        //     $request,
        //     [
        //         'TenDiaDiem' => 'required',
        //     ],
        //     [
        //         'TenDiaDiem.required' => 'Bạn chưa nhập tên địa điểm',
        //         // 'TenDiaDiem.unique' => 'Tên địa điểm đã tồn tại',
        //     ]
        // );
        // $diaDiem = new DiaDiem();
        // $diaDiem->fill([
        //     'ten_dia_diem' => $request->TenDiaDiem,
        //     'thoi_gian_mo' => $request->ThoiGianMo,
        //     'thoi_gian_dong' => $request->ThoiGianDong,
        // ]);
        // dd($diaDiem);
        // $ktDiaDiem = DiaDiem::where('ten_dia_diem', $request->input('TenDiaDiem'))->first();
        // // return ($ktDiaDanh);
        // if ($ktDiaDiem) {
        //     return Redirect::back()->with('error', 'Tên địa điểm đã tồn tại');
        // } else {
        //     $diaDiem->save(); //lưu xong mới có mã địa điểm
        //     // return Redirect::route('diaDiem.index')->with('success', 'Thêm địa điểm thành công');
        // }
        $diaDiem = new DiaDiem();
        $diaDiem->ten_dia_diem = $request->input('TenDiaDiem');
        $diaDiem->thoi_gian_mo = $request->input('ThoiGianMo');
        $diaDiem->thoi_gian_dong = $request->input('ThoiGianDong');

        $diaDiem->save();
        return response()->json(['success' => 'Dữ liệu thêm thành công']);
        // return response()->json($diaDiem);
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
        return view('component/dia-diem/diadiem-edit', compact('diaDiem'));
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
        // $this->validate(
        //     $request,
        //     [
        //         'TenDiaDiem' => 'required|unique:dia_diems,ten_dia_diem',
        //     ],
        //     [
        //         'TenDiaDiem.required' => 'Bạn chưa nhập tên địa điểm',
        //         'TenDiaDiem.unique' => 'Tên địa điểm đã tồn tại',
        //     ]
        // );
        $diaDiem->fill([
            'thoi_gian_mo' => $request->input('ThoiGianMo'),
            'thoi_gian_dong' => $request->input('ThoiGianDong'),
        ]);
        $diaDiem->save(); //lưu xong mới có mã địa điểm
        return Redirect::route('diaDiem.index')->with('success', 'Sửa địa điểm thành công');
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

    public function xoa($id)
    {
        $diaDiem = DiaDiem::find($id);
        $diaDiem->trang_thai = 0;
        $diaDiem->save();
        $diaDiem->monAns()->update(['mon_ans.trang_thai' => 0]);
        return Redirect::route('diaDiem.index');
    }
}

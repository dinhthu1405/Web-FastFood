<?php

namespace App\Http\Controllers;

use App\Models\DiaDiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDiaDiemRequest;
use App\Http\Requests\UpdateDiaDiemRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;

class DiaDiemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstDiaDiem = DiaDiem::where('trang_thai', 1)->paginate(5);
        return view('component/dia-diem/diadiem-show', compact('lstDiaDiem', 'request'));
    }

    public function index1(Request $request, $dia_diem_id)
    {
        //
        $lstDiaDiem = DiaDiem::where('trang_thai', 1)->where('id', $dia_diem_id)->paginate(5);
        return view('component/dia-diem/diadiem-show', compact('lstDiaDiem', 'request'));
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        // Search in the title and body columns from the posts table
        $lstDiaDiem = DiaDiem::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('ten_dia_diem', 'LIKE', '%' . $search . '%')
                ->orWhere('thoi_gian_mo', 'LIKE', '%' . $search . '%')
                ->orWhere('thoi_gian_dong', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('component/dia-diem/diadiem-show', compact('lstDiaDiem', 'request'));
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
        // dd(request()->KinhDo);
        // $weekMap = [
        //     0 => 'Ch??? nh???t',
        //     1 => 'Th??? hai',
        //     2 => 'Th??? ba',
        //     3 => 'Th??? t??',
        //     4 => 'Th??? n??m',
        //     5 => 'Th??? s??u',
        //     6 => 'Th??? b???y',
        // ];
        // $carbon = Carbon::now();
        // dd($weekMap[$carbon->dayOfWeek]);
        // $this->validate(
        //     $request,
        //     [
        //         'TenDiaDiem' => 'required',
        //     ],
        //     [
        //         'TenDiaDiem.required' => 'B???n ch??a nh???p t??n ?????a ??i???m',
        //         // 'TenDiaDiem.unique' => 'T??n ?????a ??i???m ???? t???n t???i',
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
        //     return Redirect::back()->with('error', 'T??n ?????a ??i???m ???? t???n t???i');
        // } else {
        //     $diaDiem->save(); //l??u xong m???i c?? m?? ?????a ??i???m
        //     // return Redirect::route('diaDiem.index')->with('success', 'Th??m ?????a ??i???m th??nh c??ng');
        // }
        // $diaDiem = new DiaDiem();
        // $diaDiem->ten_dia_diem = $request->TenDiaDiem;
        // $diaDiem->thoi_gian_mo = $request->ThoiGianMo;
        // $diaDiem->thoi_gian_dong = $request->ThoiGianDong;

        // $diaDiem->save();
        // return Redirect::route('diaDiem.index')->with('success', 'Th??m ?????a ??i???m th??nh c??ng');
        // return response()->json(['diaDiem'=>$diaDiem]);
        $this->validate(
            $request,
            [
                'TenDiaDiem' => 'required',
                'KinhDo' => 'required',
            ],
            [
                'TenDiaDiem.required' => 'B???n ch??a nh???p t??n ?????a ??i???m',
                'KinhDo.required' => 'B???n ch??a ch???n v??? tr?? tr??n b???n ?????',
                // 'TenDiaDiem.unique' => 'T??n ?????a ??i???m ???? t???n t???i',
            ]
        );
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'TenDiaDiem' => 'required',
        //         'KinhDo' => 'required',
        //         'ViDo' => 'required',
        //     ],
        //     [
        //         'TenDiaDiem.required' => 'B???n ch??a nh???p t??n ?????a ??i???m',
        //         'KinhDo.required' => 'B???n ch??a nh???p kinh ?????',
        //         'ViDo.required' => 'B???n ch??a nh???p v?? ?????',
        //         // 'TenDiaDiem.unique' => 'T??n ?????a ??i???m ???? t???n t???i',
        //     ]
        // );
        // $validator=$request->validate(
        //     [
        //         'TenDiaDiem' => 'required',
        //     ],
        //     [
        //         'TenDiaDiem.required' => 'B???n ch??a nh???p t??n ?????a ??i???m',
        //         // 'TenDiaDiem.unique' => 'T??n ?????a ??i???m ???? t???n t???i',
        //     ]
        // );
        //         $diaDiem = new DiaDiem();
        // $diaDiem->fill([
        //     'ten_dia_diem' => $request->TenDiaDiem,
        //     'thoi_gian_mo' => $request->ThoiGianMo,
        //     'thoi_gian_dong' => $request->ThoiGianDong,
        // ]);
        // // dd($diaDiem);
        // $ktDiaDiem = DiaDiem::where('ten_dia_diem', $request->input('TenDiaDiem'))->first();
        // // return ($ktDiaDanh);
        // if ($ktDiaDiem) {
        //     return Redirect::back()->with('error', 'T??n ?????a ??i???m ???? t???n t???i');
        // } else {
        //     $diaDiem->save(); //l??u xong m???i c?? m?? ?????a ??i???m
        //     return Redirect::route('diaDiem.index')->with('success', 'Th??m ?????a ??i???m th??nh c??ng');
        // }
        // $diaDiem = new DiaDiem();
        // $diaDiem->ten_dia_diem = $request->TenDiaDiem;
        // $diaDiem->thoi_gian_mo = $request->ThoiGianMo;
        // $diaDiem->thoi_gian_dong = $request->ThoiGianDong;

        // $diaDiem->save();
        // return Redirect::route('diaDiem.index')->with('success', 'Th??m ?????a ??i???m th??nh c??ng');
        // return response()->json(['diaDiem'=>$diaDiem]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator->errors(),
        //         // 'error' => $validator->messages(),
        //     ]);
        // } else {
        //     $diaDiem = new DiaDiem();
        //     $diaDiem->ten_dia_diem = $request->input('ten_dia_diem');
        //     $diaDiem->thoi_gian_mo = $request->input('thoi_gian_mo');
        //     $diaDiem->thoi_gian_dong = $request->input('thoi_gian_dong');
        //     $diaDiem->save();
        //     // return response()->json(['error' => false, 'success' => 'Th??m th??nh c??ng', 'diaDiem' => $diaDiem], 200);
        //     return response()->json(['status' => 200, 'message' => 'Th??m th??nh c??ng']);
        //     // return response()->json(['success' => 'Data is successfully added']);

        // }
        // return response()->json($diaDiem);
        $diaDiem = new DiaDiem();

        $diaDiem->fill([
            'ten_dia_diem' => $request->input('TenDiaDiem'),
            'thoi_gian_mo' => $request->input('ThoiGianMo'),
            'thoi_gian_dong' => $request->input('ThoiGianDong'),
            'kinh_do' => $request->input('KinhDo'),
            'vi_do' => $request->input('ViDo'),
        ]);

        $ktDiaDiem = DiaDiem::all()->where('ten_dia_diem', $request->input('TenDiaDiem'))->first();
        // return ($ktDiaDiem);
        if ($ktDiaDiem) {
            return Redirect::back()->with('error', 'T??n ?????a ??i???m ???? t???n t???i');
        } else {
            // dd($diaDiem);
            $diaDiem->save(); //l??u xong m???i c?? m?? ?????a ??i???m
            return Redirect::route('diaDiem.index');
        }
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
        // if($diaDiem){
        //     return response()->json([
        //                 'status' => 200,
        //                 'diaDiem' => $diaDiem,
        //                 // 'error' => $validator->messages()->get('*'),
        //             ]);
        // }
        // else{
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => 'Kh??ng t??m th???y ?????a ??i???m n??y',
        //         // 'error' => $validator->messages()->get('*'),
        //     ]);
        // }
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
        //         'TenDiaDiem.required' => 'B???n ch??a nh???p t??n ?????a ??i???m',
        //         'TenDiaDiem.unique' => 'T??n ?????a ??i???m ???? t???n t???i',
        //     ]
        // );
        $diaDiem->fill([
            'thoi_gian_mo' => $request->input('ThoiGianMo'),
            'thoi_gian_dong' => $request->input('ThoiGianDong'),
            'kinh_do' => $request->input('KinhDo'),
            'vi_do' => $request->input('ViDo'),
        ]);
        $diaDiem->save(); //l??u xong m???i c?? m?? ?????a ??i???m
        return Redirect::route('diaDiem.index')->with('success', 'S???a ?????a ??i???m th??nh c??ng');
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
        $diaDiem->hinhAnhs()->update(['hinh_anhs.trang_thai' => 0]);
        $diaDiem->danhGias()->update(['danh_gias.trang_thai' => 0]);
        $diaDiem->anhBias()->update(['anh_bias.trang_thai' => 0]);
        $diaDiem->chiTietDonHangs()->update(['chi_tiet_don_hangs.trang_thai' => 0]);
        // $diaDiem->donHangs()->update(['don_hangs.trang_thai' => 0]);
        return Redirect::route('diaDiem.index');
    }

    public function xoaNhieu(Request $request)
    {
        $id = $request->get('ids');
        // dd($id);
        if ($id == null) {
            return Redirect::route('diaDiem.index');
        } else {
            DiaDiem::find($id)->each(function ($diaDiem, $key) {
                $diaDiem->trang_thai = 0;
                $diaDiem->save();
                $diaDiem->monAns()->update(['mon_ans.trang_thai' => 0]);
                $diaDiem->hinhAnhs()->update(['hinh_anhs.trang_thai' => 0]);
                $diaDiem->danhGias()->update(['danh_gias.trang_thai' => 0]);
                $diaDiem->anhBias()->update(['anh_bias.trang_thai' => 0]);
                $diaDiem->chiTietDonHangs()->update(['chi_tiet_don_hangs.trang_thai' => 0]);
            });
            return Redirect::route('diaDiem.index');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\MonAn;
use App\Models\LoaiMonAn;
use App\Models\DiaDiem;
use App\Models\HinhAnh;
use App\Http\Requests\StoreMonAnRequest;
use App\Http\Requests\UpdateMonAnRequest;

class MonAnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //resize hình
        // $this->addMediaConversion('thumb')
        //     ->width(200)
        //     ->height(200)
        //     ->sharpen(10);

        // $this->addMediaConversion('square')
        //     ->width(412)
        //     ->height(412)
        //     ->sharpen(10);
        // $lstMonAn = MonAn::all()->where('trang_thai', 1)->sortBy('ten_mon');
        $lstMonAn = MonAn::where('trang_thai', 1)->paginate(5);
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        // foreach ($lstMonAn as $monAn) {
        //     if ($monAn->so_luong > 10) {
        //         $monAn->update(['tinh_trang' => 'Còn món']);
        //     } else if ($monAn->so_luong > 0 && $monAn->so_luong <= 10) {
        //         $monAn->update(['tinh_trang' => 'Sắp hết']);
        //     } else if ($monAn->so_luong == 0) $monAn->update(['tinh_trang' => 'Hết món']);
        // }
        return view('component/mon-an/monan-show', compact('lstMonAn', 'request', 'lstHinhAnh'));
    }

    public function images($id)
    {
        $monAn = MonAn::find($id);
        if (!$monAn) abort(404);
        $images = $monAn->hinhAnhs;
        return view('component/mon-an/monan-image', compact('monAn', 'images'));
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        if ($search != null) {
            // Search in the title and body columns from the posts table
            $lstMonAn = MonAn::where('trang_thai', 1)->where(function ($query) use ($search) {
                $query->where('ten_mon', 'LIKE', '%' . $search . '%')
                    ->orWhere('don_gia', 'LIKE', '%' . $search . '%')
                    ->orWhere('so_luong', 'LIKE', '%' . $search . '%')
                    ->orWhere('tinh_trang', 'LIKE', '%' . $search . '%');
            })->paginate(5);
            // dd($lstMonAn);

        } else if ($request->LocDonHang) {
            $locDonHang = $request->LocDonHang;
            // dd($locDonHang);
            $lstMonAn = MonAn::where('trang_thai', 1)->where('tinh_trang', $request->LocDonHang)->paginate(5);
        }
        return view('component/mon-an/monan-show', compact('lstMonAn', 'lstHinhAnh', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lstLoaiMonAn = LoaiMonAn::all();
        $lstDiaDiem = DiaDiem::all();
        return view('component/mon-an/monan-create', compact('lstLoaiMonAn', 'lstDiaDiem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMonAnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenMonAn' => 'required',
                // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'images' => 'required|max:2048',
                'DiaDiem' => 'required',
                'LoaiMonAn' => 'required',
            ],
            [
                'TenMonAn.required' => 'Bạn chưa nhập tên món ăn',
                'images.required' => 'Bạn chưa chọn hình ảnh',
                // 'images.image' => 'File bạn chọn không phải là hình ảnh',
                'images.max' => 'Bạn chỉ được chọn file hình ảnh có dung lượng nhỏ hơn 2MB',
                // 'images.mimes' => 'Bạn chỉ được chọn file hình ảnh có đuôi jpg, png, jpeg, gif, svg',
                'DiaDiem.required' => 'Bạn chưa chọn địa điểm',
                'LoaiMonAn.required' => 'Bạn chưa chọn loại món ăn',
            ]
        );
        $monAn = new MonAn();
        $don_gia = filter_var($request->input('DonGia'), FILTER_SANITIZE_NUMBER_INT);
        $monAn->fill([
            'ten_mon' => $request->input('TenMonAn'),
            'don_gia' => $don_gia,
            'so_luong' => $request->input('SoLuong'),
            'tinh_trang' => 'Còn món',
            'dia_diem_id' => $request->input('DiaDiem'),
            'loai_mon_an_id' => $request->input('LoaiMonAn'),
        ]);
        // dd($monAn);
        // $ktMonAn = MonAn::all()->where('ten_mon', $request->input('TenMonAn'))->where('trang_thai', 1)->first();

        $ktMonAn = MonAn::all()->where('ten_mon', $request->input('TenMonAn'))->where('trang_thai', 1)->first();
        // dd($ktMonAn);
        if ($ktMonAn) {
            return Redirect::back()->with('error', 'Tên món ăn đã tồn tại');
        } else {

            $monAn->save();
            $images = array();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $images = $file->store('images/mon_an/' . $monAn->id, 'public');

                    HinhAnh::insert([
                        'duong_dan' => $images,
                        'mon_an_id' => $monAn->id,
                        'trang_thai' => 1,
                    ]);
                }
            }
            return Redirect::route('monAn.index')->with('success', 'Thêm món ăn thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonAn  $monAn
     * @return \Illuminate\Http\Response
     */
    public function show(MonAn $monAn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonAn  $monAn
     * @return \Illuminate\Http\Response
     */
    public function edit(MonAn $monAn)
    {
        //
        $lstLoaiMonAn = LoaiMonAn::all();
        $lstDiaDiem = DiaDiem::all();
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1)->where('mon_an_id', $monAn->id);
        return view('component/mon-an/monan-edit', compact('monAn', 'lstLoaiMonAn', 'lstDiaDiem', 'lstHinhAnh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMonAnRequest  $request
     * @param  \App\Models\MonAn  $monAn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonAn $monAn)
    {
        //
        $this->validate(
            $request,
            [
                // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'images' => 'max:2048',
                'DiaDiem' => 'required',
                'LoaiMonAn' => 'required',
            ],
            [
                // 'images.image' => 'File bạn chọn không phải là hình ảnh',
                'images.max' => 'Bạn chỉ được chọn file hình ảnh có dung lượng nhỏ hơn 2MB',
                // 'images.mimes' => 'Bạn chỉ được chọn file hình ảnh có đuôi jpg, png, jpeg, gif, svg',
                'DiaDiem.required' => 'Bạn chưa chọn địa điểm',
                'LoaiMonAn.required' => 'Bạn chưa chọn loại món ăn',
            ]
        );

        $images = array();
        $hinhAnh = HinhAnh::where('mon_an_id', $monAn->id)->get();

        if ($request->hasFile('images')) {
            foreach ($hinhAnh as $hinh) {
                $hinh->update([
                    'trang_thai' => 0,
                ]);
            }
            foreach ($request->file('images') as $file) {
                $images = $file->store('images/mon_an/' . $monAn->id, 'public');

                HinhAnh::insert([
                    'duong_dan' => $images,
                    'mon_an_id' => $monAn->id,
                    'trang_thai' => 1,
                ]);
            }
        }
        if ($request->input('TinhTrang') == 'Còn món') {
            $tinhTrang = 'Còn món';
        } else {
            $tinhTrang = 'Hết món';
        }
        $don_gia = filter_var($request->input('DonGia'), FILTER_SANITIZE_NUMBER_INT);
        $monAn->fill([
            'don_gia' => $don_gia,
            'so_luong' => $request->input('SoLuong'),
            'tinh_trang' => $tinhTrang,
            'dia_diem_id' => $request->input('DiaDiem'),
            'loai_mon_an_id' => $request->input('LoaiMonAn'),
        ]);
        // dd($monAn);
        $monAn->save();
        return Redirect::route('monAn.index')->with('success', 'Sửa món ăn thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonAn  $monAn
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonAn $monAn)
    {
        //
    }

    public function xoa($id)
    {
        $monAn = MonAn::find($id);
        $monAn->trang_thai = 0;
        $monAn->save();
        $monAn->hinhAnhs()->update(['hinh_anhs.trang_thai' => 0]);
        $monAn->danhGias()->update(['danh_gias.trang_thai' => 0]);
        $monAn->binhLuans()->update(['binh_luans.trang_thai' => 0]);
        $monAn->anhBias()->update(['anh_bias.trang_thai' => 0]);
        return Redirect::route('monAn.index');
    }
}

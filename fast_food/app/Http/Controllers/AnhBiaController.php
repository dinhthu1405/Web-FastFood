<?php

namespace App\Http\Controllers;

use App\Models\AnhBia;
use App\Models\MonAn;
use App\Models\HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreAnhBiaRequest;
use App\Http\Requests\UpdateAnhBiaRequest;

class AnhBiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstAnhBia=AnhBia::all()->where('trang_thai',1);
        $lstHinhAnh=HinhAnh::all()->where('trang_thai',1);
        return view('component/anh-bia/anhbia-show', compact('lstAnhBia', 'lstHinhAnh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lstMonAn=MonAn::all()->where('trang_thai',1);
        return view('component/anh-bia/anhbia-create',compact('lstMonAn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnhBiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenMon' => 'required',
                // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'images' => 'required|max:2048',
            ],
            [
                'TenMon.required' => 'Bạn chưa chọn tên món ăn',
                'images.required' => 'Bạn chưa chọn hình ảnh',
                // 'images.image' => 'File bạn chọn không phải là hình ảnh',
                'images.max' => 'Bạn chỉ được chọn file hình ảnh có dung lượng nhỏ hơn 2MB',
                // 'images.mimes' => 'Bạn chỉ được chọn file hình ảnh có đuôi jpg, png, jpeg, gif, svg',
            ]
        );
        $anhBia = new AnhBia();
        $anhBia->fill([
            'mon_an_id' => $request->input('TenMon'),
        ]);
        $anhBia->save();

        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images = $file->store('images/anh_bia/' . $anhBia->id, 'public');

                HinhAnh::insert([
                    'duong_dan' => $images,
                    'anh_bia_id' => $anhBia->id,
                    'trang_thai' => 1,
                ]);
            }
        }
        return Redirect::route('anhBias.index')->with('success', 'Thêm ảnh bìa thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnhBia  $anhBia
     * @return \Illuminate\Http\Response
     */
    public function show(AnhBia $anhBia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnhBia  $anhBia
     * @return \Illuminate\Http\Response
     */
    public function edit(AnhBia $anhBia)
    {
        //
        $lstMonAn=MonAn::all()->where('trang_thai',1);
        return view('component/anh-bia/anhbia-edit',compact('anhBia','lstMonAn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnhBiaRequest  $request
     * @param  \App\Models\AnhBia  $anhBia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnhBia $anhBia)
    {
        //
        $this->validate(
            $request,
            [
                'TenMon' => 'required',
                // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'images' => 'required|max:2048',
            ],
            [
                'TenMon.required' => 'Bạn chưa chọn tên món ăn',
                'images.required' => 'Bạn chưa chọn hình ảnh',
                // 'images.image' => 'File bạn chọn không phải là hình ảnh',
                'images.max' => 'Bạn chỉ được chọn file hình ảnh có dung lượng nhỏ hơn 2MB',
                // 'images.mimes' => 'Bạn chỉ được chọn file hình ảnh có đuôi jpg, png, jpeg, gif, svg',
            ]
        );
        $anhBia->fill([
            'mon_an_id' => $request->input('TenMon'),
        ]);
        $anhBia->save();

        $hinhAnh = HinhAnh::where('anh_bia_id', $anhBia->id)->get();

        if ($request->hasFile('images')) {
            foreach ($hinhAnh as $hinh) {
                $hinh->update([
                    'trang_thai' => 0,
                ]);
            }
            foreach ($request->file('images') as $file) {
                $images = $file->store('images/mon_an/' . $anhBia->id, 'public');

                HinhAnh::insert([
                    'duong_dan' => $images,
                    'anh_bia_id' => $anhBia->id,
                    'trang_thai' => 1,
                ]);
            }
        }
        return Redirect::route('anhBias.index')->with('success', 'Sửa ảnh bìa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnhBia  $anhBia
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnhBia $anhBia)
    {
        //
    }
}

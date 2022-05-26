<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    //Phương thức hỗ trợ load hình và thay thế bằng hình mặc định nếu không tìm thấy file
    protected function fixImage(User $taiKhoan)
    {
        //chạy lệnh sau: php artisan storage:link
        if (Storage::disk('public')->exists($taiKhoan->hinh_anh)) {
            $taiKhoan->hinh_anh = Storage::url($taiKhoan->hinh_anh);
        } else {
            $taiKhoan->hinh_anh = 'assets/img/17.jpg';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        foreach ($lstTaiKhoan as $taiKhoan) {
            $this->fixImage($taiKhoan);
            //gọi fixImage cho từng sản phẩm, do lúc seed chỉ có dữ liệu giả
        }
        return view('component/tai-khoan/taikhoan-show', compact('lstTaiKhoan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(User $taiKhoan)
    {
        //
        return view('component/tai-khoan/taikhoan-edit', compact('taiKhoan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $taiKhoan)
    {
        //
        $this->validate(
            $request,
            [
                'HoTen' => 'required|max:255',
                // 'HinhAnh' => 'required',
                'SDT' => 'required|max:12',
                'NgaySinh' => 'required',
            ],
            [
                // 'Email.required' => 'required|email|unique:users',

                'SDT.required' => 'Bạn chưa nhập số điện thoại',
                'SDT.max' => 'Số điện thoại không được vượt quá 12 ký tự',
                'HoTen.max' => 'Họ tên không được vượt quá 255 ký tự',
                'HoTen.required' => 'Bạn chưa nhập họ & tên',
                'NgaySinh.required' => 'Bạn chưa chọn ngày sinh',
            ]
        );
        if ($request->hasFile('images')) {
            $taiKhoan->hinh_anh = $request->file('images')->store('images/taiKhoan/' . $taiKhoan->id, 'public');
        }
        // $isValid = password_verify($password, $hash);
        $taiKhoan->fill([
            'ho_ten' => $request->input('HoTen'),
            'sdt' => $request->input('SDT'),
            'ngay_sinh' => $request->input('NgaySinh'),
            'dia_chi' => $request->input('DiaChi'),
            'phan_loai_tai_khoan' => $request->input('PhanLoaiTaiKhoan'),
        ]);
        $taiKhoan->save();
        // dd($taiKhoan);
        return Redirect::route('taiKhoan.index')->with('success', 'Sửa tài khoản thành công');
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

    public function khoa_mo($id)
    {
        $taiKhoan = User::find($id);
        if ($taiKhoan->trang_thai == 0) {
            $taiKhoan->trang_thai = 1;
            $taiKhoan->save();
            return Redirect::route('taiKhoan.index');
        } else {
            $taiKhoan->trang_thai = 0;
            $taiKhoan->save();
            return Redirect::route('taiKhoan.index');
        }
    }
}

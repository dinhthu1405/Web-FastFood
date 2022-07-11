<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HinhAnh;
use App\Models\DiemMuaHang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{

    //Phương thức hỗ trợ load hình và thay thế bằng hình mặc định nếu không tìm thấy file
    // protected function fixImage(User $taiKhoan)
    // {
    //     //chạy lệnh sau: php artisan storage:link
    //     $hinhAnh = HinhAnh::where([['user_id', $taiKhoan->id], ['trang_thai', 1]])->select('duong_dan')->first();
    //     if (Storage::disk('public')->exists($hinhAnh)) {
    //         $hinhAnh = Storage::url($hinhAnh);
    //         // $taiKhoan->hinh_anh_id=$hinhAnh->id;
    //     } else {
    //         $hinhAnh = 'assets/img/17.jpg';
    //     }
    // }
    // protected function fixImage($id)
    // {
    //     //chạy lệnh sau: php artisan storage:link
    //     $hinhAnh = HinhAnh::where([['user_id', $id], ['trang_thai', 1]])->select('duong_dan')->first();
    //     if (Storage::disk('public')->exists($hinhAnh)) {
    //         $hinhAnh = Storage::url($hinhAnh);
    //         // $taiKhoan->hinh_anh_id=$hinhAnh->id;
    //     } else {
    //         $hinhAnh = 'assets/img/17.jpg';
    //     }
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstTaiKhoan = User::paginate(5);
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        // foreach ($lstTaiKhoan as $taiKhoan) {
        //     foreach ($lstHinhAnh as $hinhAnh)
        //         if ($taiKhoan->id == $hinhAnh->user_id) {
        //             $id = HinhAnh::where([['user_id', $taiKhoan->id], ['trang_thai', 1]])->select('duong_dan')->first();
        //         }
        // }
        // // dd($id);
        // $lstHinhAnh1 = $id;
        // dd($lstHinhAnh1);
        // dd($taiKhoan);
        // $test = User::get('id');
        // $test = User::where('id', '>', 0)->get('id');
        // $test = User::where('id', '>', 0)->get('id');
        // $testHinh = HinhAnh::where([['id', '>', 0], ['trang_thai', 1]])->get('user_id');
        // // dd($testHinh);
        // if (HinhAnh::where([['user_id', $test], ['trang_thai', 1]])) {
        //     $ten_hinh = HinhAnh::where([['user_id', $test], ['trang_thai', 1]])->get('duong_dan');
        //     dd($ten_hinh);
        // } else {
        //     dd('not ok');
        // }
        // $lstHinhAnh = HinhAnh::where([['user_id', $taiKhoan->id], ['trang_thai', 1]])->get();
        // dd($lstHinhAnh);
        return view('component/tai-khoan/taikhoan-show', compact('lstTaiKhoan', 'lstHinhAnh', 'request'));
    }

    public function index1(Request $request, $user_id, $nguoi_giao_hang_id)
    {
        if ($user_id != 0) {
            $lstTaiKhoan = User::where(function ($query) use ($user_id) {
                $query->where('id', 'LIKE', '%' . $user_id . '%');
            })->paginate(5);
        } else if ($nguoi_giao_hang_id != 0) {
            $lstTaiKhoan = User::where(function ($query) use ($nguoi_giao_hang_id) {
                $query->where('id', 'LIKE', '%' . $nguoi_giao_hang_id . '%');
            })->paginate(5);
        }

        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        return view('component/tai-khoan/taikhoan-show', compact('lstTaiKhoan', 'lstHinhAnh'));
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        // dd($search);
        // dd(date('Y-m-d', strtotime($search)));
        // dd(date('Y-m-d %H:%i:%s', strtotime($search)));
        $lstTaiKhoan = User::where(function ($query) use ($search) {
            $query->where('email', 'LIKE', '%' . $search . '%')
                ->orWhere('ho_ten', 'LIKE', '%' . $search . '%')
                ->orWhere('sdt', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->whereMonth('ngay_sinh', $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $query->whereYear('ngay_sinh', $search);
                })
                ->orWhere('ngay_sinh', 'LIKE', '%' . date('Y-m-d', strtotime($search)) . '%')
                ->orWhere('dia_chi', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1);
        return view('component/tai-khoan/taikhoan-show', compact('lstTaiKhoan', 'lstHinhAnh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component/tai-khoan/taiKhoan-create');
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
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('d-m-Y');
        // dd($before);
        $this->validate(
            $request,
            [
                'Email' => 'required|email|unique:users',
                'images' => 'required',
                'MatKhau' => 'required|alphaNum|min:6',
                'SDT' => 'regex:/^([0-9\s\(\)]*)$/|min:10|max:12',
                'HoTen' => 'required|max:255',
                'NgaySinh' => 'before:' . $before,
            ],
            [
                'Email.required' => 'Bạn chưa nhập Email',
                'Email.email' => 'Vui lòng nhập bao gồm ‘@’ trong địa chỉ email',
                'Email.unique' => 'Email đã tồn tại',
                'images.required' => 'Bạn chưa chọn hình ảnh',
                // 'images.image' => 'File bạn chọn không phải là hình ảnh',
                // 'images.max' => 'Hình ảnh phải nhỏ hơn 2MB',
                // 'images.mimes' => 'Bạn chỉ được chọn file hình ảnh có đuôi jpg, png, jpeg, gif, svg',
                'MatKhau.required' => 'Bạn chưa nhập mật khẩu',
                'MatKhau.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
                'SDT.max' => 'Số điện thoại không được vượt quá 12 ký tự',
                'SDT.regex' => 'Số điện thoại không đúng định dạng',
                'SDT.min' => 'Số điện thoại không được nhỏ hơn 10 ký tự',
                'HoTen.required' => 'Bạn chưa nhập họ tên',
                'HoTen.max' => 'Họ tên không được vượt quá 255 ký tự',
                'NgaySinh.before' => 'Chưa đủ tuổi để tham gia làm quản trị viên'
            ]
        );
        $taiKhoan = new User();
        $taiKhoan->fill([
            'email' => $request->input('Email'),
            'password' => $request->input('MatKhau'),
            'ho_ten' => $request->input('HoTen'),
            'sdt' => $request->input('SDT'),
            'ngay_sinh' => $request->input('NgaySinh'),
            'dia_chi' => $request->input('DiaChi'),
            'phan_loai_tai_khoan' => 2,
        ]);
        // dd($taiKhoan);
        $taiKhoan->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images')->store('images/taiKhoan/' . $taiKhoan->id, 'public');

            HinhAnh::insert([
                'duong_dan' => $images,
                'user_id' => $taiKhoan->id,
                'trang_thai' => 1,
            ]);
        }

        return Redirect::route('taiKhoan.index')->with('success', 'Thêm tài khoản thành công');
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
        $lstHinhAnh = HinhAnh::all()->where('trang_thai', 1)->where('user_id', $taiKhoan->id);
        return view('component/tai-khoan/taikhoan-edit', compact('taiKhoan', 'lstHinhAnh'));
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
                'SDT' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:12',
                'NgaySinh' => 'required',
                'DiaChi' => 'required|max:255',
                'MatKhau' => 'nullable|min:6',
            ],
            [
                // 'Email.required' => 'required|email|unique:users',
                'SDT.required' => 'Bạn chưa nhập số điện thoại',
                'SDT.max' => 'Số điện thoại không được vượt quá 12 ký tự',
                'SDT.regex' => 'Số điện thoại không đúng định dạng',
                'SDT.min' => 'Số điện thoại không được nhỏ hơn 10 ký tự',
                'HoTen.max' => 'Họ tên không được vượt quá 255 ký tự',
                'HoTen.required' => 'Bạn chưa nhập họ tên',
                'NgaySinh.required' => 'Bạn chưa chọn ngày sinh',
                'DiaChi.max' => 'Địa chỉ không được vượt quá 255 ký tự',
                'DiaChi.required' => 'Bạn chưa nhập địa chỉ',
                'MatKhau.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
            ]
        );
        $hinhAnh = HinhAnh::where('user_id', $taiKhoan->id)->get();
        if ($request->hasFile('images')) {
            $images = $request->file('images')->store('images/user/' . $taiKhoan->id, 'public');
            foreach ($hinhAnh as $hinh) {
                $hinh->update([
                    'trang_thai' => 0,
                ]);
            }
            HinhAnh::insert([
                'duong_dan' => $images,
                'user_id' => $taiKhoan->id,
                'trang_thai' => 1,
            ]);
        }
        // $isValid = password_verify($password, $hash);
        $user = User::find($taiKhoan->id);
        // dd(Hash::check($request->input('MatKhau'), $user->password));
        if (Hash::check($request->input('MatKhau'), $user->password)) {
            // Success
            return Redirect::back()->with('error', 'Mật khẩu mới phải khác mật khẩu cũ');
        } else if ($request->input('MatKhau') == null) {
            $taiKhoan->fill([
                'ho_ten' => $request->input('HoTen'),
                'sdt' => $request->input('SDT'),
                'ngay_sinh' => $request->input('NgaySinh'),
                'dia_chi' => $request->input('DiaChi'),
                'phan_loai_tai_khoan' => $request->input('PhanLoaiTaiKhoan'),
            ]);
        } else {
            $taiKhoan->fill([
                'mat_khau' => $request->input('MatKhau'),
                'ho_ten' => $request->input('HoTen'),
                'sdt' => $request->input('SDT'),
                'ngay_sinh' => $request->input('NgaySinh'),
                'dia_chi' => $request->input('DiaChi'),
                'phan_loai_tai_khoan' => $request->input('PhanLoaiTaiKhoan'),
            ]);
        }

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
        $lstDiemMuaHang = DiemMuaHang::all()->where('trang_thai', 1);
        if ($taiKhoan->trang_thai == 0) {

            $taiKhoan->trang_thai = 1;
            $taiKhoan->save();
            $taiKhoan->donHangs()->update(['don_hangs.trang_thai' => 1]);
            $taiKhoan->danhGias()->update(['danh_gias.trang_thai' => 1]);
            $taiKhoan->binhLuans()->update(['binh_luans.trang_thai' => 1]);
            // foreach ($lstDiemMuaHang as $diemMuaHang) {
            //     dd($diemMuaHang->user_id == $id);
            //     if ($diemMuaHang->user_id == $id) {
            //         $diemMuaHang->update([
            //             'trang_thai' => 1,
            //         ]);
            //     }
            // }
            return Redirect::route('taiKhoan.index');
        } else {
            $taiKhoan->trang_thai = 0;
            $taiKhoan->save();
            $taiKhoan->donHangs()->update(['don_hangs.trang_thai' => 0]);
            $taiKhoan->danhGias()->update(['danh_gias.trang_thai' => 0]);
            $taiKhoan->binhLuans()->update(['binh_luans.trang_thai' => 0]);

            // foreach ($lstDiemMuaHang as $diemMuaHang) {
            //     if ($diemMuaHang->user_id == $id) {
            //         $diemMuaHang->update([
            //             'trang_thai' => 0,
            //         ]);
            //     }
            // }
            // $taiKhoan->diemMuaHang()->update(['diem_mua_hangs.trang_thai' => 0]);
            return Redirect::route('taiKhoan.index');
        }
    }
}

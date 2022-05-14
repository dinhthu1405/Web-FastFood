<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login()
    {
        // return view('auth/login');

        if (Auth::check()) {

            return view('/home');
        }
        // else{
        //     Auth::logout();

        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();
        //     return back()->with('error', 'Tài khoản của bạn đã bị khóa');
        // }
        return view('auth/login');
    }
    public function checkLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'Email' => 'required',
                'MatKhau' => 'required|alphaNum|min:6',
            ],
            [
                'Email.required' => 'Bạn chưa nhập email',
                'MatKhau.required' => 'Bạn chưa nhập mật khẩu',
                'MatKhau.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            ]
        );
        $user_data = (['email' => $request->Email, 'password' => $request->MatKhau, 'trang_thai' => 1]);
        $user = User::all()->where('trang_thai', 0);
        // $user=Auth::check();
        //  dd($user);
        //     if($user){
        //         Auth::logout();

        //         $request->session()->invalidate();

        //         $request->session()->regenerateToken();

        //         return back()->with('error', 'Tài khoản của bạn đã bị khóa, hãy liên hệ với Admin.');

        // }else
        if (Auth::attempt($user_data) && Auth::user()->phan_quyen == 1) {
            $request->session()->regenerate();
            return redirect('/home')->with('success', 'Đăng nhập thành công');
        } else if (Auth::attempt($user_data) && Auth::user()->phan_quyen == 0) {
            $request->session()->regenerate();
            // dd(redirect('loi/xemLoi'));
            return redirect('loi');
            // return view('component/loi/loi-xemLoi', ['lstLoi' => $lstLoi]);
        } else {
            return back()->with('error', 'Đăng nhập không thành công');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function checkRegister(Request $request)
    {
        $this->validate(
            $request,
            [
                'Email' => 'required',
                'MatKhau' => 'required|alphaNum|min:6',
            ],
            [
                'Email.required' => 'Bạn chưa nhập email',
                'MatKhau.required' => 'Bạn chưa nhập mật khẩu',
                'MatKhau.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            ]
        );
        // $user = User::create(request(['Email', 'MatKhau']));
        $user = new User();
        $user->fill([
            'email' => $request->input('Email'),
            // 'mat_khau' => encrypt($request->input('MatKhau')),
            'password' => $request->input('MatKhau'),
            'hinh_anh' => '',
            'ho_ten' => '',
            'sdt' => '',
            'ngay_sinh' => date('d-m-Y'),
            'phan_loai_tai_khoan' => 1,
        ]);
        
        $user->save();
        // dd($user);
        auth()->login($user);
        return redirect()->to('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

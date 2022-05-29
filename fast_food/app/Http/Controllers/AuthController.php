<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\HinhAnh;

class AuthController extends Controller
{
    //
    public function login()
    {
        // return view('auth/login');
        $countId = User::all();
        if (Auth::check()) {
            return view('/home');
        } else

        if ($countId->count() == 0) {
            return view('auth/register');
        } else {
            return view('auth/login');
        }
        // else{
        //     Auth::logout();

        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();
        //     return back()->with('error', 'Tài khoản của bạn đã bị khóa');
        // }

    }
    public function checkLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|alphaNum|min:6',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            ]
        );
        $user_data = (['email' => $request->email, 'password' => $request->password, 'trang_thai' => 1]);
        // $user = User::all()->where('trang_thai', 0);
        // $user=Auth::check();
        //  dd($user);
        //     if($user){
        //         Auth::logout();

        //         $request->session()->invalidate();

        //         $request->session()->regenerateToken();

        //         return back()->with('error', 'Tài khoản của bạn đã bị khóa, hãy liên hệ với Admin.');

        // }else
        if (Auth::attempt($user_data) && Auth::user()->phan_loai_tai_khoan == 1) {
            $request->session()->regenerate();
            return redirect('/home')->with('success', 'Đăng nhập thành công');
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
                'email' => 'required',
                'password' => 'required|alphaNum|min:6',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            ]
        );
        // $user = User::create(request(['Email', 'MatKhau']));
        $user = new User();
        $user->fill([
            'email' => $request->input('email'),
            // 'mat_khau' => encrypt($request->input('MatKhau')),
            'password' => $request->input('password'),
            'ho_ten' => '',
            'sdt' => '',
            'dia_chi' => '',
            'ngay_sinh' => date('Y-m-d'),
            'phan_loai_tai_khoan' => 1,
            'remember_token' => Str::random(length: 10),
            // 'remember_token' => '',
        ]);
        $user->save();

        auth()->login($user);
        return redirect()->to('/home')->with('success', 'Đăng ký thành công');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

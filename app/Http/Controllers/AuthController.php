<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
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
            // dd('có cc');
            // dd(Auth::user()->phan_loai_tai_khoan == 0);
            if (Auth::user()->phan_loai_tai_khoan == 0 || Auth::user()->phan_loai_tai_khoan == 3) {
                return view('auth/login')->with('loi', 'Bạn không phải là quản trị viên');
            } else if (Auth::user()->trang_thai == 0) {
                return view('auth/login')->with('loi', 'Tài khoản của bạn đã bị khoá');
            } else {
                return Redirect::route('home.index');
            }
        } else        if ($countId->count() == 0) {
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
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:6',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Vui lòng nhập bao gồm ‘@’ trong địa chỉ email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            ]
        );
        $user_data = (['email' => $request->email, 'password' => $request->password, 'trang_thai' => 1]);
        if (Auth::attempt($user_data)) {
            // dd(Auth::check() && Auth::user()->phan_loai_tai_khoan != 1);
            if ((Auth::check() && Auth::user()->phan_loai_tai_khoan == 0) || (Auth::check() && Auth::user()->phan_loai_tai_khoan == 3)) {
                return back()->with('loi', 'Bạn không phải là quản trị viên');
            } else {
                $request->session()->regenerate();
                // $request->session()->put('loginId', Auth::user()->id);
                return redirect('home')->with('success', 'Đăng nhập thành công');
            }
        } else {
            return back()->with('loi', 'Tài khoản của bạn đã bị khoá');
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
        return redirect()->to('home')->with('success', 'Đăng ký thành công');
    }

    public function logout(Request $request)
    {
        // $cookie = Cookie::forget('XSRF-TOKEN');
        Auth::logout();
        // $this->guard()->logout();
        // $this->cookie($this->recaller(), null, -2000);
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

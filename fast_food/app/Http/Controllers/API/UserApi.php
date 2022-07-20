<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Models\DiemMuaHang;
use App\Models\User; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use  Laravel\Sanctum\NewAccessToken;
class UserApi extends Controller
{

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
 
        $user = new User([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'password' =>$request->password,
            'sdt'=>'',
            'ngay_sinh'=> '1999/1/1',
            'dia_chi'=>'',
            'phan_loai_tai_khoan'=>0,
            'trang_thai'=>1
        ]);
 
        $user->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }
 
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->input('remember_me')) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
 
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }
 
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function FindUser($id)
    {
        $user= User::find($id);
        $user->diemMuaHangs=DiemMuaHang::where('user_id',$user->id)->get();
        $tong = $user->diemMuaHangs->sum('so_diem');
        return $tong;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill(
            [
                'email'=>$request->input('email'),
                'password'=>1,
                'ho_ten'=>$request->input('username'),
                'sdt'=>$request->input('sdt'),
                'ngay_sinh'=>'1999/1/1',
                'dia_chi'=>$request->input('diachi'),
                'token'=>$request->input('token'),
                'phan_loai_tai_khoan'=>0,
                'trang_thai'=>1,
            ]    
            );
        $user->save();
        return $user;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        // $user=User::where('id',$id)->get();
        $user->dia_chi= $request->input('diachi');
        $user->sdt=$request->input('sdt');
        $user->ho_ten=$request->input('hoten');
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
}
}
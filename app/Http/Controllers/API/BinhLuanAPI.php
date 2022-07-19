<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use Illuminate\Http\Request;

class BinhLuanAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $binhLuan =BinhLuan::all();
        return $binhLuan;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'noi_dung' => 'required',
                'ngay_dang' => 'required',
                'tinhtrang' => 'required',
            ],
        );
        
        $donHang = new BinhLuan();
        $donHang->fill([
            'noi_dung' => $request->input("noidung"),
            'ngay_dang' =>$request->input("ngaydang"),
            'tinh_trang' => $request->input("tinhtrang"),
        ]);
        
            $donHang->save(); 
     
        return $donHang; 
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BinhLuan $binhLuan)
    {
    $binhLuan = BinhLuan::where('id',$binhLuan->id)->get();
    $binhLuan->delete();
    return [
        "message"=>" Xoá thành công bình luận"
    ];
    }
}

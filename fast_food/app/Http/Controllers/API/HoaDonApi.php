<?php

namespace App\Http\Controllers\API;
use App\Models\DonHang;
use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\DiemMuaHang;
use App\Models\HinhAnh;
use App\Models\MaGiamGia;
use App\Models\MonAn;
use App\Models\TrangThaiDonHang;
use App\Models\User;
use Illuminate\Http\Request;

class HoaDonApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donHang= DonHang::all();
        foreach ($donHang as $dh) {
           $dh->chiTietDonHangs=ChiTietDonHang::where('don_hang_id',$dh->id)->get();
           foreach ($dh->chiTietDonHangs as $dhd) {
              $dhd->MonAn=MonAn::find($dhd->mon_an_id);
           }
           $dh->trangThaiDonHang=TrangThaiDonHang::find($dh->trang_thai_don_hang_id);
           $dh->user=User::find($dh->user_id);
           $dh->shipper=User::find($dh->nguoi_giao_hang_id); 
        }
        return $donHang;
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCTDH(Request $request)
    {
        $this->validate(
            $request,
            [
                'dongia' => 'required',
                'soluong' => 'required',
                'thanhtien' => 'required',
                'monanid' => 'required',
                'trangthai'=>'required',
            ],
        );
        $ctdonghang = new ChiTietDonHang();
        $ctdonghang->fill([
            'don_gia' => $request->input('dongia'),
            'so_luong' => $request->input('soluong'),
            'thanh_tien' =>$request->input('thanhtien'),
            'don_hang_id' => $request->input('donhangid'),
            'mon_an_id' =>$request->input('monanid'),
            'trang_thai' => 0,
        ]);
 
            $ctdonghang->save(); 

        return $ctdonghang; 
    }
    public function store(Request $request,)
    {
        $this->validate(
            $request,
            [
                'ngaylapdh' => 'required',
            ],
        );
        $donHang = new DonHang();
        $donHang->fill([
            'ngay_lap_dh' => $request->input('ngaylapdh'),
            'loai_thanh_toan'=>'Tiền mặt',
            'dia_chi'=>$request->input('diachi'),
            'tong_tien'=>$request->input('tongtien'),
            'trang_thai_don_hang_id' => 1,
            'nguoi_giao_hang_id' => 1,
            'user_id' =>$request->input('user'),
            'trang_thai'=>0,
        ]);
      
        $donHang->save(); 
        foreach($request->input('chitietdonhang') as $value)     
        {  
            $chitietdonhang = new Chitietdonhang();
            $chitietdonhang->don_hang_id=$donHang->id;
            $chitietdonhang->don_gia= $value["dongia"];
            $chitietdonhang->so_luong=$value["soluong"];
            $chitietdonhang->thanh_tien=$value["thanhtien"];
            $chitietdonhang->mon_an_id=$value["monanid"];
            $chitietdonhang->trang_thai=$value["trangthai"];
            $chitietdonhang->save();
            
        }
        $diemMuaHang= new DiemMuaHang();
        $diemMuaHang->fill([
            'so_diem'=>$donHang->tong_tien*0.05,
            'user_id'=>$donHang->user_id,
            'don_hang_id'=>$donHang->id,
        ]);
        $diemMuaHang->save();
        return [$donHang,
        $chitietdonhang
    ]; 
        
    }
  public function showMaGiamGia(){
    $magiamgia=MaGiamGia::all();
    return $magiamgia;
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
    public function update(Request $request,$id)
    {
        $donHang=DonHang::where('id',$id)->get();
        // dd($donHang);
        foreach ($donHang as  $value) {
           $value->trang_thai_don_hang_id= $request->input('trangthai')+2;
           $value->nguoi_giao_hang_id=$request->input('nguoigiaohang');
           $value->save(); 
        }
        return $donHang; 
        
    }
    public function UpdateCTDonHang(Request $request, DonHang $donHang){
        $this->validate(
            $request,
            [
                "chitietdonhang"=>"required"
            ],
        );
        $donHang->CTDonHang= $request->input('chitietdonhang');
        $donHang->save(); 
        return $donHang;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonHang $donHang)
    {
        $donHang->chiTietDonHangs = ChiTietDonHang::where('don_hang_id',$donHang->id)->get();
        $donHang->delete();
        return response()->json([
            'status' => 'Xoa Thanh Cong',
            'message' => '1 don hang da bi xoa'
        ]);
    }
    public function destroyCTDH(ChiTietDonHang $ctdonhang)   
    {
        $ctdonhang->delete();
        return response()->json([
            'status' => 'Xoa Thanh Cong',
            'message' => '1 don hang da bi xoa'
        ]);
    }
}

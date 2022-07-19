<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnhBia;
use App\Models\MonAn;
use App\Models\DanhGia;
use App\Models\DiaDiem;
use App\Models\HinhAnh;
use App\Models\LoaiMonAn;
use App\Models\User;
use App\Models\YeuThich;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

class MonAnApi extends Controller
{
    public function storeDanhGia(Request $request){
        $this->validate(
            $request,
            [
                'danhgiasao' => 'required',
                'noidung' => 'required',
                'user'=>'required',
                'monan'=>'required',
                'diadiem'=>'required',
            ],
        );
        $danhGia = new DanhGia();
        $danhGia->fill([
            "danh_gia_sao"=>$request->input('danhgiasao'),
            "noi_dung"=>$request->input('noidung'),
            "user_id"=>$request->input('user'),
            "mon_an_id"=>$request->input('monan'),
            "dia_diem_id"=>$request->input('diadiem'),
            "trang_thai"=>0,
        ]);
        $danhGia->save();
        $get_name =$request->file('hinhanh');
        dd($get_name);
        foreach ($get_name as $value) {
            $hinhAnh = new hinhAnh();
            $hinhAnh->danh_gia_id=$danhGia->id;
            $get_image=$value;
            $path='images/food/';
            $get_name_images=$get_image->getClientOriginalName();
            $name_images= current(explode('.',$get_name_images));
            $new_images= $name_images.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_images);
            $hinhAnh->duong_dan=$path+$new_images;
            $hinhAnh->save();

        }
        $danhGia->save();
        return $danhGia;
    }
    public function index()
    {
        $monAn = MonAn::all();
        foreach($monAn as $item){
            $sum= $item->danhGias =DanhGia::where('mon_an_id',$item->id)->get();
            $tong= $sum->sum('danh_gia_sao');
            $count=count($sum); 
            if($count==0){
                $count=1;
            }
            $item->danhGias=round($tong/$count,1) ;
            $item->hinhAnhs=HinhAnh::find($item->id);
            $item->diaDiem=DiaDiem::find($item->dia_diem_id);
            $item->loaiMonAn = LoaiMonAn::find($item->loai_mon_an_id);
            // $item->yeuThich=YeuThich::find($item->id);
        }
        return $monAn;
    }
    public function allAnhBia(){
        $anhBia= AnhBia::all();
        foreach ($anhBia as $value) {
            $value->monAn= MonAn::find($value->mon_an_id);
            $value->hinhAnh= HinhAnh::find($value->id);
        }
        return $anhBia;
    }
    public function ShowDanhGia(MonAn $monAn){
       $monAn->danhGias= DanhGia::where('mon_an_id',$monAn->id)->get();
       $monAn->loaiMonAn =LoaiMonAn::find($monAn->loai_mon_an_id);
       foreach($monAn->danhGias as $item){
        $item->User= User::find($item->user_id);

       }
       return $monAn;
    }
    public function ShowUserDanhGia(User $user){
        $user->danhGias= DanhGia::where('user_id',$user->id)->get();
        foreach($user->DanhGias as $item){
         $item->user= User::where('id',$item->id)->get();
        }
        return $user;
     }
    public function FindFoodGood(){
        $monAn= MonAn::all();
        foreach($monAn as $item){
            $sum= $item->danhGia =DanhGia::where('mon_an_id',$item->id)->get();
            $tong= $sum->sum('danh_gia_sao');
            $item->danhGia=round($tong/count($sum),1) ;
        }
        $find =$monAn->filter(
            function($key){
                return $key->DanhGia >=4.0;
            }
        );

        return $find;
    }
    public function Star(MonAn $monAn){
      $sum= $monAn->danhGias =DanhGia::where('mon_an_id',$monAn->id)->get();
      $tong= $sum->sum('danh_gia_sao');
      $avg=$tong/count($sum);
    //   $avg= $sum/count($sum);
        return [
            'MonAn'=>$monAn,
            'Star'=>round($avg,1),
        ];
    }
    public function LoaiMonAn(){
        $loaiMonAn = LoaiMonAn::all();
        foreach ($loaiMonAn as  $value) {
           $value->monAns = MonAn::where('loai_mon_an_id',$value->id)->get();
        }
        return $loaiMonAn;
    }
    public function MonAnWithType(LoaiMonAn $loaiMonAn){
        $loaiMonAn->monAns = MonAn::where('loai_mon_an_id',$loaiMonAn->id)->get();
        foreach ($loaiMonAn->monAns as $value) {
            $value->hinhAnhs= HinhAnh::find($value->id);
        }
        return $loaiMonAn;
    }
    // public function MonAnWithFavorite(MonAn $monAn){
    //   $monAn->yeuThich=YeuThich::
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMonAn($id)
    {    
        $monAn=MonAn::find($id);
        $monAn->hinhAnhs=HinhAnh::find($monAn->id);
        $monAn->diaDiem=DiaDiem::find($monAn->dia_diem_id);
        $monAn->loaiMonAn=LoaiMonAn::find($monAn->loai_mon_an_id);
        $sum= $monAn->danhGias =DanhGia::where('mon_an_id',$monAn->id)->get();
        $tong= $sum->sum('danh_gia_sao');
        $count=count($sum); 
        if($count==0){
            $count=1;
        }
        $monAn->danhGias=round($tong/$count,1) ;
        return $monAn;
    }
    public function FoodFavorite(Request $request){
        $favorite = new YeuThich();
        $favorite->fill(
            [
                'yeu_thich'=>1,
                'mon_an_id'=>$request->input('monan'),
                'user_id'=>$request->input('user'),
                'trang_thai'=>1,
            ]
            );
        $favorite->save();
        return $favorite;
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
    public function destroyDanhGia(DanhGia $danhGia)
    {
        $danhGia->delete();
        return [
            "messages"=>"Xoá thành công bình luận ",
        ];
    }
    public function destroyLike($id){
        $yeuThich= YeuThich::find($id);
        $yeuThich->delete();
        return[
            'message'=>'Xoa'
        ];
    }
}

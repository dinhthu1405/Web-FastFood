<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonHang extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'don_hangs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ngay_lap_dh',
        'tong_tien',
        'loai_thanh_toan',
        'dia_chi',
        'trang_thai_don_hang_id',
        'nguoi_giao_hang_id',
        'user_id',
        'trang_thai',
    ];
    public function trangThaiDonHang()
    {
        return $this->belongsTo(TrangThaiDonhang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHangs::class, 'id');
    }

    public function diemMuaHang()
    {
        return $this->belongsTo(DiemMuaHang::class, 'id');
    }
}

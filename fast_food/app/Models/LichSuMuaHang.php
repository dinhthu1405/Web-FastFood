<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuMuaHang extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'don_hang_id',
        'trang_thai_don_hang_id',
        'mon_an_id',
        'trang_thai',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function trangThaiDonHang()
    {
        return $this->belongsTo(TrangThaiDonHang::class, 'trang_thai_don_hang_id');
    }

    public function monAn()
    {
        return $this->belongsTo(MonAn::class, 'mon_an_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonAn extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ten_mon',
        'don_gia',
        'so_luong',
        'tinh_trang',
        'dia_diem_id',
        'loai_mon_an_id',
        'danh_gia_id',
        'trang_thai',
    ];

    public function loaiMonAn()
    {
        return $this->belongsTo(LoaiMonAn::class);
    }

    public function diaDiem()
    {
        return $this->belongsTo(DiaDiem::class);
    }

    public function hinhAnhs()
    {
        return $this->hasMany(HinhAnh::class);
    }

    public function chiTietDonHang()
    {
        return $this->belongsTo(ChiTietDonHang::class);
    }

    public function danhGias()
    {
        return $this->hasMany(DinhGia::class);
    }
}

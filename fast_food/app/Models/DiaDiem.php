<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaDiem extends Model
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
        'ten_dia_diem',
        'thoi_gian_mo',
        'thoi_gian_dong',
        'kinh_do',
        'vi_do',
        'trang_thai',
    ];

    public function monAns()
    {
        return $this->hasMany(MonAn::class);
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class);
    }

    public function hinhAnhs()
    {
        return $this->hasManyThrough(HinhAnh::class, MonAn::class);
    }

    public function hinhAnh()
    {
        return $this->hasOneThrough(HinhAnh::class, MonAn::class);
    }

    public function binhLuans()
    {
        return $this->hasManyThrough(BinhLuan::class, MonAn::class);
    }

    public function binhLuan()
    {
        return $this->hasOneThrough(BinhLuan::class, MonAn::class);
    }

    public function anhBias()
    {
        return $this->hasManyThrough(AnhBia::class, MonAn::class);
    }

    public function anhBia()
    {
        return $this->hasOneThrough(AnhBia::class, MonAn::class);
    }

    public function chiTietDonHangs()
    {
        return $this->hasManyThrough(ChiTietDonHang::class, MonAn::class);
    }

    public function chiTietDonHang()
    {
        return $this->hasOneThrough(ChiTietDonHang::class, MonAn::class);
    }
}

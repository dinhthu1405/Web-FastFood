<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MaGiamGia extends Model
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
        'ten_ma',
        'so_luong',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'loai_giam_gia_id',
        'trang_thai',
    ];

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y\TH:i');
    }

    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y\TH:i');
    }

    public function loaiGiamGia()
    {
        return $this->belongsTo(LoaiGiamGia::class, 'loai_giam_gia_id', 'id');
    }
}

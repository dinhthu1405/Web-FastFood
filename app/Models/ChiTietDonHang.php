<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietDonHang extends Model
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
        'don_gia',
        'so_luong',
        'thanh_tien',
        'don_hang_id',
        'mon_an_id',
        'trang_thai',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class);
    }

    public function monAns()
    {
        return $this->hasMany(MonAn::class, 'id', 'mon_an_id');
    }
}

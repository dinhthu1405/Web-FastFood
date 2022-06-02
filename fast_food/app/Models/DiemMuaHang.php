<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemMuaHang extends Model
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
        'so_diem',
        'user_id',
        'don_hang_id',
        'trang_thai',
    ];

    public function user()
    {
        return $this->belongsTo(DiemMuaHang::class, 'user_id', 'id');
    }

    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'don_hang_id', 'id');
    }
}

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
        return $this->belongsTo(DiemMuaHang::class, 'id');
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'id');
    }
}

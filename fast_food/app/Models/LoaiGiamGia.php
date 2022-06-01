<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiGiamGia extends Model
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
        'ten_loai_giam_gia',
        'trang_thai',
    ];

    public function maGiamGias()
    {
        return $this->hasMany(MaGiamGia::class, 'id_loai_giam_gia', 'id');
    }
}

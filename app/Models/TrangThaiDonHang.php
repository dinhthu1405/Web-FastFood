<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrangThaiDonHang extends Model
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
        'ten_trang_thai',
        'trang_thai',
    ];

    public function donHangs()
    {
        return $this->hasMany(DonHang::class);
    }

}

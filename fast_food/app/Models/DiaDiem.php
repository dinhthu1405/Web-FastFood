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
        'trang_thai',
    ];

    protected $weekMap = [
        0 => 'SU',
        1 => 'MO',
        2 => 'TU',
        3 => 'WE',
        4 => 'TH',
        5 => 'FR',
        6 => 'SA',
    ];

    public function monAns()
    {
        return $this->hasMany(MonAn::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhBia extends Model
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
        'mon_an_id',
        'trang_thai',
    ];

    public function monAn()
    {
        return $this->belongsTo(MonAn::class, 'mon_an_id', 'id');
    }

    public function hinhAnh()
    {
        return $this->belongsTo(HinhAnh::class, 'id');
    }
}

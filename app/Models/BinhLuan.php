<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
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
        'noi_dung',
        'thoi_gian',
        'user_id',
        'mon_an_id',
        'trang_thai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function monAn()
    {
        return $this->belongsTo(MonAn::class, 'id');
    }
}

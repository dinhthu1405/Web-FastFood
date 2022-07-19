<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $fillable = [
        'id',
        'email',
        'password',
        'ho_ten',
        'sdt',
        'ngay_sinh',
        'dia_chi',
        'phan_loai_tai_khoan',
        'trang_thai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
        // $this->attributes['password'] = Crypt::encrypt($password); //Mã hoá
        // $this->attributes['password'] = Crypt::decrypt($password); //Giải mã
    }

    public function hinhAnh()
    {
        return $this->hasOne(HinhAnh::class, 'id');
    }

    public function hinhAnhs()
    {
        return HinhAnh::all()->where('user_id', Auth::user()->id);
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class);
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class);
    }

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class);
    }

    public function diemMuaHangs()
    {
        return $this->hasMany(DiemMuaHang::class, 'id');
    }

    public function yeu_thichs()
    {
        return $this->hasMany(YeuThich::class, 'id');
    }
}

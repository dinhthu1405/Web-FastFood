<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Chờ xác nhận
        // Xác nhận giao
        // Chờ giao
        // Đang giao
        // Đã nhận
        // Xác nhận đã giao
        // Đơn hàng boom
        // Hoàn thành
        for ($i = 1; $i <= 9; $i++) {
            DB::table('don_hangs')->insert([
                'ngay_lap_dh' => '2022-06-0' . $i,
                'tong_tien' => $i * 10000,
                'loai_thanh_toan' => 'Tiền mặt',
                'dia_chi' => '112 Tân Phú, TP.HCM',
                'trang_thai_don_hang_id' => '1',
                'nguoi_giao_hang_id' => '3',
                'user_id' => '2',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaGiamGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 25; $i++) {
            DB::table('ma_giam_gias')->insert([
                'ten_ma' => 'Khuyến mãi ' . $i,
                'so_luong' => $i + 1,
                'ngay_bat_dau' => '2022-12-12',
                'ngay_ket_thuc' => '2022-12-12',
                'loai_giam_gia_id' => $i,
            ]);
        }
    }
}

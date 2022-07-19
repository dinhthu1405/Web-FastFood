<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 9; $i++) {
            DB::table('chi_tiet_don_hangs')->insert([
                'don_gia' => $i * 1000,
                'so_luong' => $i,
                'thanh_tien' => $i * 1000,
                'don_hang_id' => $i,
                'mon_an_id' => '1',
            ]);
        }
    }
}

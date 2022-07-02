<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiaDiemSeeder extends Seeder
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
            DB::table('dia_diems')->insert([
                'ten_dia_diem' => 'Khu ' . $i,
                'thoi_gian_mo' => '12:30',
                'thoi_gian_dong' => '13:30',
                'kinh_do' => '12.5',
                'vi_do' => '12.6',
            ]);
        }
    }
}

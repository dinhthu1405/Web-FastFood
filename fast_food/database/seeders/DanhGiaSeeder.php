<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DanhGiaSeeder extends Seeder
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
            DB::table('danh_gias')->insert([
                'danh_gia_sao' => $i,
                'noi_dung' => Str::random(10),
                'user_id' => '1',
                'mon_an_id' => '1',
                'dia_diem_id' => '1',
            ]);
        }
    }
}

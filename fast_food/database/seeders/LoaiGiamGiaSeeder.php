<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiGiamGiaSeeder extends Seeder
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
            DB::table('loai_giam_gias')->insert([
                'ten_loai_giam_gia' => 'Khuyến mãi ' . $i,
            ]);
        }
    }
}

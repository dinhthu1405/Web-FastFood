<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BinhLuanSeeder extends Seeder
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
            DB::table('binh_luans')->insert([
                'noi_dung' => Str::random(10),
                'thoi_gian' => '2022-12-12',
                'mon_an_id' => '1',
                'user_id' => '2',
            ]);
        }
    }
}

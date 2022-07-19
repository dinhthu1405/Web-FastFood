<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiMonAnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1;$i<=25;$i++){
            DB::table('loai_mon_ans')->insert([
                'ten_loai' =>'bánh bao '.$i,
            ]);
        }
        // 'password' => Hash::make('password'),
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LoaiMonAnSeeder::class,
            DiaDiemSeeder::class,
            DanhGiaSeeder::class,
            BinhLuanSeeder::class,
            LoaiGiamGiaSeeder::class,
            MonAnSeeder::class,
            MaGiamGiaSeeder::class,
            DonHangSeeder::class,
            ChiTietDonHangSeeder::class,
        ]);
    }
}

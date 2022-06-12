<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ngay_lap_dh');
            $table->decimal('tong_tien', 9, 3);
            $table->unsignedBigInteger('trang_thai_don_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('nguoi_giao_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('user_id')->nullable(); //khoá ngoại
            $table->boolean('trang_thai')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('don_hangs');
    }
}

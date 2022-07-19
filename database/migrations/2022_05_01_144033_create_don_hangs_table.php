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
            $table->double('tong_tien');
            $table->string('loai_thanh_toan');
            $table->string('dia_chi')->nullable();
            $table->unsignedBigInteger('trang_thai_don_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('nguoi_giao_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('user_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('ma_giam_gia_id')->nullable(); //khoá ngoại
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

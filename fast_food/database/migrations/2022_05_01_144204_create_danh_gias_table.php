<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->double('danh_gia_sao');
            $table->text('noi_dung');
            $table->dateTime('thoi_gian');
            $table->boolean('duyet')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('mon_an_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('dia_diem_id')->nullable(); //khoá ngoại
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
        Schema::dropIfExists('danh_gias');
    }
}

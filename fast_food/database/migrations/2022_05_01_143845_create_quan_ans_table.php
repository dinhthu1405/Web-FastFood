<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuanAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quan_ans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_quan');
            $table->date('thoi_gian_mo')->nullable();
            $table->date('thoi_gian_dong')->nullable();
            $table->string('sdt')->nullable();
            $table->unsignedBigInteger('dia_diem_id');
            $table->unsignedBigInteger('ma_giam_gia_id');
            $table->unsignedBigInteger('danh_gia_id');
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
        Schema::dropIfExists('quan_ans');
    }
}

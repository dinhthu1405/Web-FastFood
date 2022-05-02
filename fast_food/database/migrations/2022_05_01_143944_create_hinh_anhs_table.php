<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHinhAnhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinh_anhs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_hinh');
            $table->unsignedBigInteger('mon_an_id');
            $table->unsignedBigInteger('quan_an_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ma_giam_gia_id');
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
        Schema::dropIfExists('hinh_anhs');
    }
}

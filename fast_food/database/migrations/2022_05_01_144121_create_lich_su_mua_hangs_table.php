<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichSuMuaHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_mua_hangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('don_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('trang_thai_don_hang_id')->nullable(); //khoá ngoại
            $table->unsignedBigInteger('mon_an_id')->nullable(); //khoá ngoại
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
        Schema::dropIfExists('lich_su_mua_hangs');
    }
}

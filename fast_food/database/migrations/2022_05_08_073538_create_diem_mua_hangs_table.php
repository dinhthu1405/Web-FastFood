<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiemMuaHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_mua_hangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('so_diem');
            $table->unsignedBigInteger('user_id')->nullable();//khoá ngoại
            $table->unsignedBigInteger('don_hang_id')->nullable();//khoá ngoại
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
        Schema::dropIfExists('diem_mua_hangs');
    }
}

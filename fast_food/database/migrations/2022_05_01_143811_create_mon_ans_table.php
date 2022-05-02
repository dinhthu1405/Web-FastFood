<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mon_ans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_mon');
            $table->double('don_gia');
            $table->string('tinh_trang');
            $table->unsignedBigInteger('quan_an_id');
            $table->unsignedBigInteger('loai_mon_an_id');
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
        Schema::dropIfExists('mon_ans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableYeuThichsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeu_thichs', function (Blueprint $table) {
            $table->id();
            $table->integer('yeu_thich');
            $table->unsignedBigInteger('mon_an_id')->nullable();//khoá ngoại
            $table->unsignedBigInteger('user_id')->nullable();//khoá ngoại
            $table->boolean('trang_thai')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yeu_thichs');
    }
}

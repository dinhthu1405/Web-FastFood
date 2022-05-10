<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoiGiaoHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoi_giao_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email', 250)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sdt');
            $table->date('ngay_sinh');
            $table->rememberToken();
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
        Schema::dropIfExists('nguoi_giao_hangs');
    }
}

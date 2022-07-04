<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreign('diem_mua_hang_id')->references('id')->on('diem_mua_hangs');
        // });
        Schema::table('mon_ans', function (Blueprint $table) {
            $table->foreign('dia_diem_id')->references('id')->on('dia_diems');
            $table->foreign('loai_mon_an_id')->references('id')->on('loai_mon_ans');
        });
        // Schema::table('dia_diems', function (Blueprint $table) {
        //     $table->foreign('danh_gia_id')->references('id')->on('danh_gias');
        // });
        Schema::table('hinh_anhs', function (Blueprint $table) {
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ma_giam_gia_id')->references('id')->on('ma_giam_gias');
            $table->foreign('anh_bia_id')->references('id')->on('anh_bias');
            $table->foreign('binh_luan_id')->references('id')->on('binh_luans');
        });
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->foreign('trang_thai_don_hang_id')->references('id')->on('trang_thai_don_hangs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('nguoi_giao_hang_id')->references('id')->on('users');
        });
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->foreign('don_hang_id')->references('id')->on('don_hangs');
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
        });
        Schema::table('lich_su_mua_hangs', function (Blueprint $table) {
            $table->foreign('don_hang_id')->references('id')->on('don_hangs');
            $table->foreign('trang_thai_don_hang_id')->references('id')->on('trang_thai_don_hangs');
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
        });
        Schema::table('danh_gias', function (Blueprint $table) {
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
            $table->foreign('user_id')->references('id')->on('users');
        });
        // Schema::table('nguoi_giao_hangs', function (Blueprint $table) {
        //     $table->foreign('danh_gia_id')->references('id')->on('danh_gias');
        // });
        Schema::table('ma_giam_gias', function (Blueprint $table) {
            $table->foreign('loai_giam_gia_id')->references('id')->on('loai_giam_gias');
        });
        Schema::table('anh_bias', function (Blueprint $table) {
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
        });
        Schema::table('diem_mua_hangs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('don_hang_id')->references('id')->on('don_hangs');
        });
        Schema::table('yeu_thichs', function (Blueprint $table) {
            $table->foreign('mon_an_id')->references('id')->on('mon_ans');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key');
    }
}

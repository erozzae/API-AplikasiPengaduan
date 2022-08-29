<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balasan', function (Blueprint $table) {
            $table->bigIncrements('id_balasan');
            $table->foreignId('id_komplain_saran');
            $table->foreign('id_komplain_saran')->references('id_komplain_saran')->on('komplain')->onDelete('cascade');
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->text('balasan');
            $table->enum('status',['diajukan','diterima','ditolak','diproses','selesai']);
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
        Schema::dropIfExists('balasan');
    }
}

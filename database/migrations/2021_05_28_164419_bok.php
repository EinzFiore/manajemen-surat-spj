<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_export');
            $table->string('ket_terima');
            $table->string('kode_rekening');
            $table->double('uang_keluar');
            $table->string('keterangan');
            $table->string('penerima');
            $table->text('alamat_penerima');
            $table->year('tahun_anggaran');
            $table->integer('id_penyetuju');
            $table->integer('id_pengetahu');
            $table->integer('id_pembayar');
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
        //
    }
}
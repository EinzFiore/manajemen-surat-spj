<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->integer('no_bku')->primary();
            $table->integer('id_export');
            $table->string('ket_terima');
            $table->string('kode_rekening');
            $table->string('no_bukti');
            $table->double('uang_keluar');
            $table->string('keterangan');
            $table->string('penerima');
            $table->string('alamat_penerima');
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
        Schema::dropIfExists('surat');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pphnon', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('no_dokumen');
            $table->string('tgl_dokumen');
            $table->unsignedBigInteger('pphnon_id');
            $table->foreign('pphnon_id')->references('id')->on('pph_nonresiden')->onDelete('cascade');
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
        Schema::dropIfExists('dokumen_pphnon');
    }
};

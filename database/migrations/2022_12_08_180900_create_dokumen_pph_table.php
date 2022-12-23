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
        Schema::create('dokumen_pphpasal', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('no_dokumen');
            $table->string('tgl_dokumen');
            $table->unsignedBigInteger('pphpasal_id');
            $table->foreign('pphpasal_id')->references('id')->on('pphpasal')->onDelete('cascade');
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
        Schema::dropIfExists('dokumen_pphpasal');
    }
};

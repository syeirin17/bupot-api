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
        Schema::create('posting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pphsendiri_id')->nullable()->constrained('pphsendiri');
            $table->foreignId('pphpasal_id')->nullable()->constrained('pphpasal');
            $table->foreignId('pph_nonresiden_id')->nullable()->constrained('pph_nonresiden');
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
        Schema::dropIfExists('posting');
    }
};

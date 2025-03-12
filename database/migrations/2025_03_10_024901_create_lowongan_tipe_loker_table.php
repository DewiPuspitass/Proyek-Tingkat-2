<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lowongan_tipe_loker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lowongan_id');
            $table->unsignedBigInteger('tipe_id');
            $table->timestamps();

            $table->foreign('lowongan_id')->references('id')->on('lowongan_kerja')->onDelete('cascade');
            $table->foreign('tipe_id')->references('id')->on('tipe_lowongan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_tipe_loker');
    }
};

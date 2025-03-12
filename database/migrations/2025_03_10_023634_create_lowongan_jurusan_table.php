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
        Schema::create('lowongan_jurusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lowongan_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->timestamps();
            
            $table->foreign('lowongan_id')->references('id')->on('lowongan_kerja')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_jurusan');
    }
};

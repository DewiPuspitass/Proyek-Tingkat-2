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
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id();
            $table->string("nama_pekerjaan");
            $table->string("nama_perusahaan");
            $table->string("domisili_perusahaan");
            $table->string("domisili_penempatan");
            $table->string(("gaji"));
            $table->date('tanggal_post');
            $table->text("deskripsi");
            $table->text("kualifikasi");
            $table->text("persyaratan");
            $table->string('foto_loker');
            $table->text("persiapan_berkas");
            $table->text("link_submit");
            $table->date("batas_submit");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};

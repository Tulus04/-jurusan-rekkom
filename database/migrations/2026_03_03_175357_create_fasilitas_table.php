<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel fasilitas.
 *
 * Menyimpan data fasilitas jurusan (lab, ruangan, dll).
 */
return new class extends Migration {
    /**
     * Buat tabel fasilitas.
     */
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255)->comment('Nama fasilitas');
            $table->text('deskripsi')->comment('Deskripsi fasilitas');
            $table->string('gambar')->nullable()->comment('Path gambar fasilitas');
            $table->string('icon', 50)->nullable()->comment('Class Bootstrap icon');
            $table->integer('urutan')->default(0)->comment('Urutan tampil');
            $table->boolean('is_active')->default(true)->comment('Status aktif/nonaktif');
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel fasilitas.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};

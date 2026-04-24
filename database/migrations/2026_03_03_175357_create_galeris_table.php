<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel galeris.
 *
 * Menyimpan foto-foto galeri kegiatan jurusan.
 */
return new class extends Migration {
    /**
     * Buat tabel galeris.
     */
    public function up(): void
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255)->comment('Judul/caption foto');
            $table->text('deskripsi')->nullable()->comment('Deskripsi singkat');
            $table->string('gambar')->comment('Path file gambar');
            $table->string('kategori', 100)->nullable()->comment('Kategori: Kegiatan, Fasilitas, dll');
            $table->integer('urutan')->default(0)->comment('Urutan tampil');
            $table->boolean('is_active')->default(true)->comment('Status aktif/nonaktif');
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel galeris.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};

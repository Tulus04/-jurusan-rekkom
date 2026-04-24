<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel dosens.
 *
 * Menyimpan data dosen dan staff jurusan.
 */
return new class extends Migration {
    /**
     * Buat tabel dosens.
     */
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255)->comment('Nama lengkap dosen');
            $table->string('nidn', 50)->nullable()->comment('Nomor Induk Dosen Nasional');
            $table->string('jabatan', 100)->comment('Jabatan fungsional');
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('foto')->nullable()->comment('Path file foto');
            $table->text('bidang_keahlian')->nullable()->comment('Bidang keahlian/spesialisasi');
            $table->text('bio')->nullable()->comment('Biografi singkat');
            $table->integer('urutan')->default(0)->comment('Urutan tampil di halaman');
            $table->boolean('is_active')->default(true)->comment('Status aktif/nonaktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Hapus tabel dosens.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};

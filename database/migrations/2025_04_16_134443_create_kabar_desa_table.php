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
        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kabar_desa', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('ringkasan');
            $table->text('isi');
            $table->string('gambar')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->date('tgl_publish')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori_berita')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabar_desa');
        Schema::dropIfExists('kategori_berita');
    }
};

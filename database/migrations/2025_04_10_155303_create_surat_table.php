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
        Schema::create('surat_type', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sub_surat_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_type_id')->constrained('surat_type')->onDelete('cascade');
            $table->string('nama_sub_surat');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_surat_type_id')->constrained('sub_surat_type')->onDelete('cascade');
            $table->string('nomor_surat');
            $table->date('tgl_surat');
            $table->json('data_pemohon');
            $table->json('data_surat')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
        Schema::dropIfExists('sub_surat_type');
        Schema::dropIfExists('surat_type');
    }
};

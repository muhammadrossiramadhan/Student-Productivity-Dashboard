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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users, jika user dihapus, tugasnya ikut terhapus
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('nama_tugas');
            $table->text('deskripsi')->nullable();
            $table->date('deadline');
            $table->time('waktu');
            $table->enum('prioritas', ['Tinggi', 'Sedang', 'Rendah'])->default('Sedang');
            $table->enum('status', ['Belum Selesai', 'Selesai'])->default('Belum Selesai');
            $table->timestamp('selesai_at')->nullable();
            $table->integer('poin_konsistensi')->default(0);
            
            $table->timestamps(); // Otomatis membuat created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

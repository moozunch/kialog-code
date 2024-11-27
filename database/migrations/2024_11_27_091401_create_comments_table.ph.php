<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Foreign key ke posts
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke users
            $table->text('content'); // Kolom untuk konten komentar
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments'); // Menghapus tabel comments jika migrasi di-revert
    }
};

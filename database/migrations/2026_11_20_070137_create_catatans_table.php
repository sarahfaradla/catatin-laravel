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
        Schema::create('catatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('judul', 150);
            $table->string('matkul', 100);
            $table->string('jurusan', 50);
            $table->foreignId('category_id')->constrained('categories');                        
            $table->string('deskripsi', 255);
            $table->string('tautan', 500);
            $table->enum('visibilitas', ['pribadi', 'publik'])->default('pribadi');
            $table->boolean('anonim')->default(false);
            $table->enum('status', ['Draft', 'Terbit', 'Dilaporkan'])->default('Draft');
            $table->unsignedInteger('upvote')->default(0);
            $table->text('alasan')->nullable();                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatans');
    }
};



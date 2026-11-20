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
        Schema::table('catatans', function (Blueprint $table) {
            $table->dropColumn('tipe');
            $table->foreignId('category_id')->after('jurusan')->constrained('categories');
        });
    }

    public function down(): void
    {
        Schema::table('catatans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->string('tipe', 20)->nullable();
        });
    }
};



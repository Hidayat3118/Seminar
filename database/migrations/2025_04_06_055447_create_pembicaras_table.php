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
        Schema::create('pembicaras', function (Blueprint $table) {
            $table->id();
            $table->string('instansi')->nullable();
            $table->string('bio')->nullable();
            $table->string('pengalaman')->nullable();
            $table->string('foto')->nullable();
            $table->string('linkend')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kategori_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembicaras');
    }
};

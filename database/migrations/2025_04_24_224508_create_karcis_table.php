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
        Schema::create('karcis', function (Blueprint $table) {
            $table->id();
            $table->char('qr_code')->nullable();
            $table->timestamp('waktu_sqan')->nullable(); 
            $table->enum('status', ['active', 'used']);
            $table->string('token')->nullable();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karcis');
    }
};

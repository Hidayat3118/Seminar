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
        
            Schema::create('pesertas', function (Blueprint $table) {
                $table->id();
                $table->string('alamat')->nullable();
                $table->string('foto')->nullable();
                $table->string('instansi')->nullable();
                $table->timestamps();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            });
            
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};

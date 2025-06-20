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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['pending', 'completed', 'failed', 'cenceled', 'refunden']);
            $table->string('invoice_url')->nullable();
            $table->integer('diskon')->default(0);
            $table->string('snap_token')->nullable();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->foreignId('voucher_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

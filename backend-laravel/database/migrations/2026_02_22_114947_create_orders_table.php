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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relasi ke user
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Nomor invoice unik
            $table->string('invoice_number')->unique();

            // Informasi harga
            $table->decimal('total_price', 15, 2)->default(0);

            // Status pesanan
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'cancelled'
            ])->default('pending');

            // File desain upload (optional)
            $table->string('design_file')->nullable();

            // Catatan pelanggan
            $table->text('notes')->nullable();

            // Tracking produksi
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
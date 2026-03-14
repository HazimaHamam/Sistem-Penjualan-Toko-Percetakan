<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->unique();
        $table->date('tanggal');
        $table->string('produk');
        $table->integer('qty');
        $table->decimal('harga', 12, 2);
        $table->decimal('total', 14, 2);
        $table->string('pelanggan')->nullable();
        $table->string('metode_pembayaran');
        $table->string('status');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};

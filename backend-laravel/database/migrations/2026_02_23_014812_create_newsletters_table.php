<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();

            // Opsional – siap dikembangkan
            $table->boolean('is_active')->default(true);

            // Opsional – untuk unsubscribe / verification
            // $table->string('unsubscribe_token')->nullable()->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
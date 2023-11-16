<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('reference');
            $table->string('title');
            $table->string('status');
            $table->float('price');
            $table->float('promotional_price')->nullable();
            $table->dateTime('promotion_starts_on')->nullable();
            $table->dateTime('promotion_ends_on')->nullable();
            $table->integer('quantity');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

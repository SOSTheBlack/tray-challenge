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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->string('reference');
            $table->string('title');
            $table->string('status');
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->dateTime('sale_starts_on')->nullable();
            $table->dateTime('sale_ends_on')->nullable();
            $table->integer('stock');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

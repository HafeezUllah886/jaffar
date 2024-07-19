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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salesID')->constrained('sales', 'id');
            $table->foreignId('productID')->constrained('products', 'id');
            $table->float('qty');
            $table->float('price', 10);
            $table->float('discount');
            $table->float('discountValue');
            $table->float('scheme');
            $table->float('schemeValue');
            $table->float('amount');
            $table->date('date');
            $table->foreignId('unitID')->constrained('units', 'id');
            $table->float('unitValue');
            $table->string('batchNumber');
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};

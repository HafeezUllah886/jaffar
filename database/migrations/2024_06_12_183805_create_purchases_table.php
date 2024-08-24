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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendorID')->constrained('accounts', 'id');
            $table->date('date');
            $table->float("st")->default(0);
            $table->float('stValue')->default(0);
            $table->float("wh")->default(0);
            $table->float('whValue')->default(0);
            $table->float('discount')->default(0);
            $table->float('compensation')->default(0);
            $table->text('notes')->nullable();
            $table->float('gst')->default(0);
            $table->float('fed')->default(0);
            $table->float('sed')->default(0);
            $table->float('net')->default(0);
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

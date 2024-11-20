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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->string('name', 30);
            $table->integer('amount');
            $table->text('description')->nullable(); 
            $table->date('create'); 
            $table->integer('sold')->default(0); 
            $table->integer('price');
            $table->integer('size');
            $table->float('rate', 3, 2)->default(0.0); 
            $table->timestamps();
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
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
        Schema::create('camisetas_a_categorias', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('camisetas_id') 
                ->references('id')
                ->on('camisetas'); 
            $table->foreignId('categorias_id') 
                ->references('id')
                ->on('categorias'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camisetas_a_categorias');
    }
};

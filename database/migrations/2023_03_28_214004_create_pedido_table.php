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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id') 
                ->references('id')
                ->on('compra'); 
            $table->foreignId('camiseta_id') 
                ->references('id')
                ->on('camiseta'); 
            $table->string('nombre_a_estampar');
            $table->string('numero_a_estampar');
            $table->string('talle_elegido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};

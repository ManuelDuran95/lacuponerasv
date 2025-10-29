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
    Schema::create('detalles_compras', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('compra_id');
        $table->unsignedBigInteger('oferta_id');
        $table->unsignedBigInteger('usuario_id');

        $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
        $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade');
        $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

        $table->string('codigo_unico')->unique();
        $table->decimal('precio_unitario',10,2);
        $table->boolean('canjeado')->default(false);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};

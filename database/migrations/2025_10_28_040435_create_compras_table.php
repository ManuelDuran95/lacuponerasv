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
    Schema::create('compras', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('usuario_id');
        $table->unsignedBigInteger('empresa_id');

        $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

        $table->decimal('total',10,2);
        $table->dateTime('fecha_compra');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};

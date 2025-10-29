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
    Schema::create('ofertas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('empresa_id');
        $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

        $table->string('titulo_oferta');
        $table->decimal('precio_regular',10,2);
        $table->decimal('precio_oferta',10,2);

        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->date('fecha_limite_canje');

        // null = ilimitado
        $table->integer('cantidad_cupones')->nullable();

        $table->text('descripcion');
        $table->enum('estado',['DISPONIBLE','NO_DISPONIBLE'])->default('DISPONIBLE');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};

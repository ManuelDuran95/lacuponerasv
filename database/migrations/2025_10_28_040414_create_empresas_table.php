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
    Schema::create('empresas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_empresa');
        $table->string('nit')->unique();
        $table->text('direccion');
        $table->string('telefono', 20);
        $table->string('correo_electronico')->unique();
        $table->string('usuario')->unique();
        $table->string('contrasena'); // guardada hasheada
        $table->enum('estado', ['PENDIENTE','APROBADA','RECHAZADA'])->default('PENDIENTE');
        $table->decimal('porcentaje_comision',5,2)->nullable(); // set por el admin al aprobar
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};

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
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('usuario')->unique();
        $table->string('correo_electronico')->unique();
        $table->string('contrasena');
        $table->string('nombre_completo')->nullable();
        $table->string('apellidos')->nullable();
        $table->string('dui', 20)->nullable();
        $table->date('fecha_nacimiento')->nullable();

        $table->enum('rol', ['ADMIN','EMPRESA','USUARIO'])->default('USUARIO');

        // si este usuario representa una empresa aprobada
        $table->unsignedBigInteger('empresa_id')->nullable();
        $table->foreign('empresa_id')
              ->references('id')->on('empresas')
              ->onDelete('set null');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

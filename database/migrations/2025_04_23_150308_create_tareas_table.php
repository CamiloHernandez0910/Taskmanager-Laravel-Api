<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id(); // ID único
            $table->string('titulo'); // Título de la tarea
            $table->text('descripcion')->nullable(); // Descripción (opcional)
            $table->boolean('completada')->default(false); // Si está completada
            $table->timestamps(); // created_at y updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};

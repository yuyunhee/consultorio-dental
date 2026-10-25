
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->restrictOnDelete();

            $table->foreignId('medico_id')
                ->constrained('medicos')
                ->restrictOnDelete();

            $table->foreignId('consultorio_id')
                ->constrained('consultorios')
                ->restrictOnDelete();

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->string('estado', 20)->default('programada');
            $table->string('motivo', 255)->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();

            $table->index(['fecha', 'medico_id']);
            $table->index(['fecha', 'consultorio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};

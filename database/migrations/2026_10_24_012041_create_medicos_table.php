
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('especialidad_id')
                ->constrained('especialidades')
                ->restrictOnDelete();

            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('cedula_profesional', 30)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('correo')->nullable()->unique();
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'telefono',
        'correo',
        'curp',
        'direccion',
        'alergias',
        'activo',
    ];
    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'activo' => 'boolean',
        ];
    }
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
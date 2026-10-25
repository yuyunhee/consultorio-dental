<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Consultorio;
use App\Models\Cita;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;


class AgendarCitaController extends Controller
{
    public function create()
    {
        $especialidades = Especialidad::where('activa', true)
            ->whereHas('medicos', function ($query) {
                $query->where('activo', true);
            })
            ->orderBy('nombre')
            ->get();

        return view('agendar.create', compact('especialidades'));
    }


public function horarios(Request $request)
{
    $datos = $request->validate([
        'especialidad_id' => 'required|exists:especialidades,id',
        'fecha' => 'required|date|after_or_equal:today',
    ]);

    $especialidad = Especialidad::where('activa', true)
        ->whereKey($datos['especialidad_id'])
        ->firstOrFail();

    $medicos = Medico::where('especialidad_id', $especialidad->id)
        ->where('activo', true)
        ->with('citas')
        ->orderBy('apellido')
        ->orderBy('nombre')
        ->get();

    $consultorios = Consultorio::where('activo', true)->get();

    $horarios = [];

    $inicio = strtotime('09:00');
    $fin = strtotime('17:00');

    for ($hora = $inicio; $hora + 3600 <= $fin; $hora += 3600) {
        $horaInicio = date('H:i:s', $hora);
        $horaFin = date('H:i:s', $hora + 3600);

        foreach ($medicos as $medico) {
            $ocupado = Cita::where('medico_id', $medico->id)
                ->whereDate('fecha', $datos['fecha'])
                ->where('estado', '!=', 'cancelada')
                ->where('hora_inicio', '<', $horaFin)
                ->where('hora_fin', '>', $horaInicio)
                ->exists();

            if ($ocupado) {
                continue;
            }

            $consultorioLibre = $consultorios->first(function ($consultorio) use (
                $datos, $horaInicio, $horaFin
            ) {
                return !Cita::where('consultorio_id', $consultorio->id)
                    ->whereDate('fecha', $datos['fecha'])
                    ->where('estado', '!=', 'cancelada')
                    ->where('hora_inicio', '<', $horaFin)
                    ->where('hora_fin', '>', $horaInicio)
                    ->exists();
            });

            if ($consultorioLibre) {
                $horarios[] = [
                    'hora_inicio' => substr($horaInicio, 0, 5),
                    'hora_fin' => substr($horaFin, 0, 5),
                ];

                break;
            }
        }
    }

    return response()->json($horarios);
}


public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'telefono' => 'required|string|max:20',
        'correo' => 'nullable|email|max:255',
        'especialidad_id' => 'required|integer|exists:especialidades,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => [
            'required',
            'date_format:H:i',
            'regex:/^(09|10|11|12|13|14|15|16):00$/',
        ],
        'motivo' => 'nullable|string|max:1000',
    ]);

    $horaInicio = $datos['hora_inicio'] . ':00';
    $horaFin = date(
        'H:i:s',
        strtotime($datos['hora_inicio'] . ' +60 minutes')
    );

    try {
        $cita = DB::transaction(function () use (
            $datos, $horaInicio, $horaFin
        ) {
            $especialidad = Especialidad::whereKey(
                $datos['especialidad_id']
            )
                ->where('activa', true)
                ->first();

            if (!$especialidad) {
                throw ValidationException::withMessages([
                    'especialidad_id' =>
                        'Esta especialidad ya no está disponible.',
                ]);
            }

            $medicos = Medico::where(
                'especialidad_id',
                $especialidad->id
            )
                ->where('activo', true)
                ->orderBy('apellido')
                ->orderBy('nombre')
                ->lockForUpdate()
                ->get();

            $medicoDisponible = null;

            foreach ($medicos as $medico) {
                $ocupado = Cita::where('medico_id', $medico->id)
                    ->whereDate('fecha', $datos['fecha'])
                    ->where('estado', '!=', 'cancelada')
                    ->where('hora_inicio', '<', $horaFin)
                    ->where('hora_fin', '>', $horaInicio)
                    ->exists();

                if (!$ocupado) {
                    $medicoDisponible = $medico;
                    break;
                }
            }

            if (!$medicoDisponible) {
                throw ValidationException::withMessages([
                    'hora_inicio' =>
                        'Ya no hay médicos disponibles en ese horario. Selecciona otro.',
                ]);
            }

            $consultorios = Consultorio::where('activo', true)
                ->orderBy('nombre')
                ->lockForUpdate()
                ->get();

            $consultorioDisponible = null;

            foreach ($consultorios as $consultorio) {
                $ocupado = Cita::where(
                    'consultorio_id',
                    $consultorio->id
                )
                    ->whereDate('fecha', $datos['fecha'])
                    ->where('estado', '!=', 'cancelada')
                    ->where('hora_inicio', '<', $horaFin)
                    ->where('hora_fin', '>', $horaInicio)
                    ->exists();

                if (!$ocupado) {
                    $consultorioDisponible = $consultorio;
                    break;
                }
            }

            if (!$consultorioDisponible) {
                throw ValidationException::withMessages([
                    'hora_inicio' =>
                        'No hay consultorios disponibles en ese horario.',
                ]);
            }

            $paciente = Paciente::where(
                'telefono',
                $datos['telefono']
            )->first();

            if (!$paciente) {
                $paciente = Paciente::create([
                    'nombre' => $datos['nombre'],
                    'apellido' => $datos['apellido'],
                    'telefono' => $datos['telefono'],
                    'correo' => $datos['correo'] ?: null,
                    'activo' => true,
                ]);
            } else {
                $paciente->update([
                    'nombre' => $datos['nombre'],
                    'apellido' => $datos['apellido'],
                    'correo' => $datos['correo'] ?: null,
                ]);
            }

            return Cita::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medicoDisponible->id,
                'consultorio_id' => $consultorioDisponible->id,
                'fecha' => $datos['fecha'],
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'estado' => 'programada',
                'motivo' => $datos['motivo'] ?? null,
            ]);
        });
    } catch (ValidationException $e) {
        throw $e;
    }

    return view('agendar.exito');
}


}

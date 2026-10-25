<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['paciente', 'medico.especialidad', 'consultorio'])
            ->orderByDesc('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = Paciente::where('activo', true)
            ->orderBy('apellido')->orderBy('nombre')->get();

        $medicos = Medico::where('activo', true)
            ->with('especialidad')
            ->orderBy('apellido')->orderBy('nombre')->get();

        $consultorios = Consultorio::where('activo', true)
            ->orderBy('nombre')->get();

        return view('citas.create', compact(
            'pacientes', 'medicos', 'consultorios'
        ));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'motivo' => 'nullable|string|max:1000',
            'observaciones' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($datos) {
            $medico = Medico::whereKey($datos['medico_id'])
                ->lockForUpdate()->firstOrFail();

            $consultorio = Consultorio::whereKey($datos['consultorio_id'])
                ->lockForUpdate()->firstOrFail();

            if (!$medico->activo) {
                throw ValidationException::withMessages([
                    'medico_id' => 'No se pueden asignar citas a un médico inactivo.',
                ]);
            }

            if (!$consultorio->activo) {
                throw ValidationException::withMessages([
                    'consultorio_id' => 'No se pueden asignar citas a un consultorio inactivo.',
                ]);
            }

            $hayCruceMedico = Cita::where('medico_id', $datos['medico_id'])
                ->where('fecha', $datos['fecha'])
                ->where('estado', '!=', 'cancelada')
                ->where('hora_inicio', '<', $datos['hora_fin'])
                ->where('hora_fin', '>', $datos['hora_inicio'])
                ->exists();

            if ($hayCruceMedico) {
                throw ValidationException::withMessages([
                    'hora_inicio' => 'El médico ya tiene una cita en ese horario.',
                ]);
            }

            $hayCruceConsultorio = Cita::where('consultorio_id', $datos['consultorio_id'])
                ->where('fecha', $datos['fecha'])
                ->where('estado', '!=', 'cancelada')
                ->where('hora_inicio', '<', $datos['hora_fin'])
                ->where('hora_fin', '>', $datos['hora_inicio'])
                ->exists();

            if ($hayCruceConsultorio) {
                throw ValidationException::withMessages([
                    'consultorio_id' => 'El consultorio ya está ocupado en ese horario.',
                ]);
            }

            $datos['estado'] = 'programada';

            Cita::create($datos);
        });

        return redirect()->route('citas.index')
            ->with('success', 'Cita programada correctamente.');
    }

    public function show(Cita $cita)
    {
        $cita->load(['paciente', 'medico.especialidad', 'consultorio']);

        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $pacientes = Paciente::orderBy('apellido')->orderBy('nombre')->get();
        $medicos = Medico::with('especialidad')->orderBy('apellido')->orderBy('nombre')->get();
        $consultorios = Consultorio::orderBy('nombre')->get();

        return view('citas.edit', compact(
            'cita', 'pacientes', 'medicos', 'consultorios'
        ));
    }

    public function update(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'estado' => 'required|in:programada,realizada,cancelada',
            'motivo' => 'nullable|string|max:1000',
            'observaciones' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($datos, $cita) {
            $medico = Medico::whereKey($datos['medico_id'])
                ->lockForUpdate()->firstOrFail();

            $consultorio = Consultorio::whereKey($datos['consultorio_id'])
                ->lockForUpdate()->firstOrFail();

            if ($datos['estado'] !== 'cancelada') {
                if (!$medico->activo) {
                    throw ValidationException::withMessages([
                        'medico_id' => 'El médico seleccionado está inactivo.',
                    ]);
                }

                if (!$consultorio->activo) {
                    throw ValidationException::withMessages([
                        'consultorio_id' => 'El consultorio seleccionado está inactivo.',
                    ]);
                }

                foreach (['medico_id', 'consultorio_id'] as $campo) {
                    $cruce = Cita::where($campo, $datos[$campo])
                        ->where('fecha', $datos['fecha'])
                        ->where('estado', '!=', 'cancelada')
                        ->where('id', '!=', $cita->id)
                        ->where('hora_inicio', '<', $datos['hora_fin'])
                        ->where('hora_fin', '>', $datos['hora_inicio'])
                        ->exists();

                    if ($cruce) {
                        throw ValidationException::withMessages([
                            $campo => $campo === 'medico_id'
                                ? 'El médico ya tiene una cita en ese horario.'
                                : 'El consultorio ya está ocupado en ese horario.',
                        ]);
                    }
                }
            }

            $cita->update($datos);
        });

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->update(['estado' => 'cancelada']);

        return redirect()->route('citas.index')
            ->with('success', 'Cita cancelada correctamente.');
    }
}

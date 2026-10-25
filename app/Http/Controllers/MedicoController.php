<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::with('especialidad')
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->get();

        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        $especialidades = Especialidad::where('activa', true)
            ->orderBy('nombre')
            ->get();

        return view('medicos.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula_profesional' => 'required|string|max:50|unique:medicos,cedula_profesional',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255|unique:medicos,correo',
        ]);

        $datos['activo'] = true;

        Medico::create($datos);

        return redirect()->route('medicos.index')
            ->with('success', 'Médico registrado correctamente.');
    }

    public function show(Medico $medico)
    {
        $medico->load('especialidad', 'citas');

        return view('medicos.show', compact('medico'));
    }

    public function edit(Medico $medico)
    {
        $especialidades = Especialidad::orderBy('nombre')->get();

        return view('medicos.edit', compact('medico', 'especialidades'));
    }

    public function update(Request $request, Medico $medico)
    {
        $datos = $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula_profesional' => [
                'required', 'string', 'max:50',
                Rule::unique('medicos', 'cedula_profesional')->ignore($medico->id),
            ],
            'telefono' => 'nullable|string|max:20',
            'correo' => [
                'nullable', 'email', 'max:255',
                Rule::unique('medicos', 'correo')->ignore($medico->id),
            ],
            'activo' => 'required|boolean',
        ]);

        $medico->update($datos);

        return redirect()->route('medicos.index')
            ->with('success', 'Médico actualizado correctamente.');
    }

    public function destroy(Medico $medico)
    {
        if ($medico->citas()->exists()) {
            return redirect()->route('medicos.index')
                ->with('error', 'No puedes eliminar un médico que tiene citas registradas. Puedes desactivarlo desde Editar.');
        }

        $medico->delete();

        return redirect()->route('medicos.index')
            ->with('success', 'Médico eliminado correctamente.');
    }
}

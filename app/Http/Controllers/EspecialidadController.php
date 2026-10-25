<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::orderBy('nombre')->get();

        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Especialidad::create($datos);

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad registrada correctamente.');
    }

  public function edit(Especialidad $especialidade)
{
    return view('especialidades.edit', [
        'especialidad' => $especialidade,
    ]);
}

    public function update(Request $request, Especialidad $especialidad)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('especialidades', 'nombre')->ignore($especialidad->id),
            ],
            'descripcion' => 'nullable|string',
            'activa' => 'required|boolean',
        ]);

        $especialidade->update($datos);

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Especialidad $especialidade)
    {
        if ($especialidade->medicos()->exists()) {
            return redirect()->route('especialidades.index')
                ->with('error', 'No se puede eliminar una especialidad que tiene médicos asociados.');
        }

        $especialidade->delete();

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad eliminada correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConsultorioController extends Controller
{
    public function index()
    {
        $consultorios = Consultorio::orderBy('nombre')->get();

        return view('consultorios.index', compact('consultorios'));
    }

    public function create()
    {
        return view('consultorios.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100|unique:consultorios,nombre',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $datos['activo'] = true;

        Consultorio::create($datos);

        return redirect()->route('consultorios.index')
            ->with('success', 'Consultorio registrado correctamente.');
    }

    public function show(Consultorio $consultorio)
    {
        $consultorio->load('citas');

        return view('consultorios.show', compact('consultorio'));
    }

    public function edit(Consultorio $consultorio)
    {
        return view('consultorios.edit', compact('consultorio'));
    }

    public function update(Request $request, Consultorio $consultorio)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('consultorios', 'nombre')->ignore($consultorio->id),
            ],
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'required|boolean',
        ]);

        $consultorio->update($datos);

        return redirect()->route('consultorios.index')
            ->with('success', 'Consultorio actualizado correctamente.');
    }

    public function destroy(Consultorio $consultorio)
    {
        if ($consultorio->citas()->exists()) {
            return redirect()->route('consultorios.index')
                ->with('error', 'No puedes eliminar un consultorio que tiene citas registradas. Puedes desactivarlo desde Editar.');
        }

        $consultorio->delete();

        return redirect()->route('consultorios.index')
            ->with('success', 'Consultorio eliminado correctamente.');
    }
}

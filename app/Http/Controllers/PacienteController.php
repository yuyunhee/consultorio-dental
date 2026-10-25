<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all(); 

        return view('pacientes.index', compact('pacientes'));
    }


    public function create()
    {
        return view('pacientes.create');
    }

   public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'fecha_nacimiento' => 'nullable|date',
        'telefono' => 'required|string|max:20',
        'correo' => 'nullable|email|unique:pacientes,correo',
        'curp' => 'nullable|string|size:18|unique:pacientes,curp',
        'direccion' => 'nullable|string',
        'alergias' => 'nullable|string',
    ]);

    Paciente::create($datos);

    return redirect()->route('pacientes.index')
        ->with('success', 'Paciente registrado exitosamente.');
    }

    
    public function show(Paciente $paciente)
{
    $paciente->load('citas');

    return view('pacientes.show', compact('paciente'));
}


    public function edit(string $id)
    {
        return view('pacientes.edit');
    }


    public function update(Request $request, string $id)
    {
        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado con éxito.');
    }


    public function destroy(string $id)
    {
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado con éxito.');
    }
}

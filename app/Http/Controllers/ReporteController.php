<?php
namespace App\Http\Controllers;
use App\Models\Cita;
use App\Models\Medico;
class ReporteController extends Controller
{
    public function index()
    {
        $totalCitas = Cita::count();
        $programadas = Cita::where('estado', 'programada')->count();
        $realizadas = Cita::where('estado', 'realizada')->count();
        $canceladas = Cita::where('estado', 'cancelada')->count();
        $medicos = Medico::with('especialidad')
            ->withCount('citas')
            ->withCount([
                'citas as consultas_realizadas_count' => function ($query) {
                    $query->where('estado', 'realizada');
                },
            ])
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->get();
        return view('reportes.index', compact(
            'totalCitas',
            'programadas',
            'realizadas',
            'canceladas',
            'medicos'
        ));
    }
}
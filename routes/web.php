<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AgendarCitaController;

Route::get('/', function () {
    return view('inicio');
});

Route::resource('especialidades', EspecialidadController::class);
Route::resource('medicos', MedicoController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('consultorios', ConsultorioController::class);
Route::resource('citas', CitaController::class);


Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');


Route::get('/reportes', [ReporteController::class, 'index'])
    ->name('reportes.index');


Route::get('/agendar-cita', [AgendarCitaController::class, 'create'])
    ->name('agendar.create');


Route::get('/agendar-cita/horarios', [
    AgendarCitaController::class,
    'horarios'
])->name('agendar.horarios');


Route::post('/agendar-cita', [AgendarCitaController::class, 'store'])
    ->name('agendar.store');

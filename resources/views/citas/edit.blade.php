<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar cita | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('citas.index') }}" class="boton">Volver al listado</a>
      <a href="{{ url('/admin') }}" class="boton1">Administracion</a>
</div>
    </header>
<main class="contenedor-pacientes">
    <h1>Editar cita</h1>
    <p style="margin: -10px 0 20px 0; color: #6b7280; font-size: 14px;">Modifica los datos de la cita seleccionada.</p>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('citas.update', $cita) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="paciente_id">Paciente *</label>
        <select name="paciente_id" id="paciente_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="">Selecciona un paciente</option>
            @foreach ($pacientes as $paciente)
                <option value="{{ $paciente->id }}"
                    @selected(old('paciente_id', $cita->paciente_id) == $paciente->id)>
                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                </option>
            @endforeach
        </select>

        <label for="medico_id">Médico *</label>
        <select name="medico_id" id="medico_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="">Selecciona un médico</option>
            @foreach ($medicos as $medico)
                <option value="{{ $medico->id }}"
                    @selected(old('medico_id', $cita->medico_id) == $medico->id)>
                    {{ $medico->nombre }} {{ $medico->apellido }} — {{ $medico->especialidad->nombre ?? '' }}
                </option>
            @endforeach
        </select>

        <label for="consultorio_id">Consultorio *</label>
        <select name="consultorio_id" id="consultorio_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="">Selecciona un consultorio</option>
            @foreach ($consultorios as $consultorio)
                <option value="{{ $consultorio->id }}"
                    @selected(old('consultorio_id', $cita->consultorio_id) == $consultorio->id)>
                    {{ $consultorio->nombre }}
                </option>
            @endforeach
        </select>

        <label for="fecha">Fecha *</label>
        <input type="date" id="fecha" name="fecha"
            min="{{ now()->toDateString() }}"
            value="{{ old('fecha', $cita->fecha->format('Y-m-d')) }}"
            required>

        <label for="hora_inicio">Hora de inicio *</label>
        <input type="time" id="hora_inicio" name="hora_inicio"
            value="{{ old('hora_inicio', substr($cita->hora_inicio, 0, 5)) }}"
            required>

        <label for="hora_fin">Hora de fin *</label>
        <input type="time" id="hora_fin" name="hora_fin"
            value="{{ old('hora_fin', substr($cita->hora_fin, 0, 5)) }}"
            required>

        <label for="estado">Estado de la cita *</label>
        <select name="estado" id="estado" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="programada"
                @selected(old('estado', $cita->estado) === 'programada')>
                Programada
            </option>
            <option value="realizada"
                @selected(old('estado', $cita->estado) === 'realizada')>
                Realizada
            </option>
            <option value="cancelada"
                @selected(old('estado', $cita->estado) === 'cancelada')>
                Cancelada
            </option>
        </select>

        <label for="motivo">Motivo de la consulta</label>
        <input id="motivo" name="motivo" maxlength="1000"
            value="{{ old('motivo', $cita->motivo) }}">

        <label for="observaciones">Observaciones</label>
        <textarea id="observaciones" name="observaciones">{{ old('observaciones', $cita->observaciones) }}</textarea>

        <button type="submit">Guardar cambios</button>
    </form>
<br>
</main>
</body>
</html>

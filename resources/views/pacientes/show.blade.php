
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del paciente | Sonrisa Dental</title>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('pacientes.index') }}" class="boton">Volver al listado</a>
     <a href="{{ url('/admin') }}" class="boton1">Administracion</a>
</div>
    </header>
    <main class="contenedor-pacientes">
        <h1>Detalles del paciente</h1>

        <p><strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->apellido }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $paciente->fecha_nacimiento?->format('d/m/Y') ?? 'No registrada' }}</p>
        <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
        <p><strong>Correo:</strong> {{ $paciente->correo ?: 'No registrado' }}</p>
        <p><strong>CURP:</strong> {{ $paciente->curp ?: 'No registrada' }}</p>
        <p><strong>Dirección:</strong> {{ $paciente->direccion ?: 'No registrada' }}</p>
        <p><strong>Alergias:</strong> {{ $paciente->alergias ?: 'No registradas' }}</p>

        <h2>Historial de citas</h2>

        @forelse ($paciente->citas as $cita)
            <p>
                {{ $cita->fecha->format('d/m/Y') }}
                — {{ $cita->hora_inicio }}
                — {{ $cita->estado }}
            </p>
        @empty
            <p>Este paciente aún no tiene citas registradas.</p>
        @endforelse

        <p><a href="{{ route('pacientes.edit', $paciente) }}">Editar paciente</a></p>
        <p><a href="{{ route('pacientes.index') }}">Volver al listado</a></p>
    </main>
</body>
</html>

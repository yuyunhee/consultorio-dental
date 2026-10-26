<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar paciente | Sonrisa Dental</title>
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
        <h1>Editar paciente</h1>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre(s) *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>

            <label for="apellido">Apellidos *</label>
            <input id="apellido" name="apellido" value="{{ old('apellido', $paciente->apellido) }}" required>

            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                   value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento?->format('Y-m-d')) }}">

            <label for="telefono">Teléfono *</label>
            <input id="telefono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" required>

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo', $paciente->correo) }}">

            <label for="curp">CURP</label>
            <input id="curp" name="curp" maxlength="18" value="{{ old('curp', $paciente->curp) }}">

            <label for="direccion">Dirección</label>
            <textarea id="direccion" name="direccion">{{ old('direccion', $paciente->direccion) }}</textarea>

            <label for="alergias">Alergias</label>
            <textarea id="alergias" name="alergias">{{ old('alergias', $paciente->alergias) }}</textarea>

            <button type="submit">Guardar cambios</button>
        </form>

        <p><a href="{{ route('pacientes.index') }}">Cancelar</a></p>
    </main>
</body>
</html>

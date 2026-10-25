<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar médico | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

 <header class="encabezado">
        <a href="/" class="logo">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('medicos.index') }}" class="boton">Volver al listado</a>
     <a href="{{ url('/') }}" class="boton1">Volver al inicio</a>
</div>


    </header>

<main class="contenedor-pacientes">
    <h1>Registrar médico</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($especialidades->isEmpty())
        <div class="sin-datos" style="text-align: center; margin-top: 20px;">
            <p>Primero debes registrar y activar una especialidad.</p>
            <a href="{{ route('especialidades.create') }}" class="boton" style="display: inline-block; margin-top: 10px;">Registrar especialidad</a>
        </div>
    @else
        <form action="{{ route('medicos.store') }}" method="POST">
            @csrf

            <label for="nombre">Nombre *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="100">

            <label for="apellido">Apellido *</label>
            <input id="apellido" name="apellido" value="{{ old('apellido') }}" required maxlength="100">

            <label for="cedula_profesional">Cédula profesional *</label>
            <input id="cedula_profesional" name="cedula_profesional" value="{{ old('cedula_profesional') }}" required maxlength="50">

            <label for="especialidad_id">Especialidad *</label>
            <select id="especialidad_id" name="especialidad_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
                <option value="">Selecciona una especialidad</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}" @selected(old('especialidad_id') == $especialidad->id)>
                        {{ $especialidad->nombre }}
                    </option>
                @endforeach
            </select>

            <label for="telefono">Teléfono</label>
            <input id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="20">

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}">

            <button type="submit">Guardar médico</button>
        </form>
    @endif
<br>
</main>
</body>
</html>

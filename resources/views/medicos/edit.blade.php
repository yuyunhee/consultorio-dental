<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar médico | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('medicos.index') }}" class="boton">Volver al listado</a>
    <a href="{{ url('/admin') }}" class="boton1">Administracion</a>
</div>
    </header>
<main class="contenedor-pacientes">
    <h1>Editar médico</h1>
    <p style="margin: -10px 0 20px 0; color: #6b7280; font-size: 14px;">Actualiza la información del médico.</p>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicos.update', $medico) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre *</label>
        <input type="text" id="nombre" name="nombre"
            value="{{ old('nombre', $medico->nombre) }}" required maxlength="100">

        <label for="apellido">Apellido *</label>
        <input type="text" id="apellido" name="apellido"
            value="{{ old('apellido', $medico->apellido) }}" required maxlength="100">

        <label for="cedula_profesional">Cédula profesional *</label>
        <input type="text" id="cedula_profesional" name="cedula_profesional"
            value="{{ old('cedula_profesional', $medico->cedula_profesional) }}"
            required maxlength="50">

        <label for="especialidad_id">Especialidad *</label>
        <select name="especialidad_id" id="especialidad_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            @foreach ($especialidades as $especialidad)
                <option value="{{ $especialidad->id }}"
                    @selected(old('especialidad_id', $medico->especialidad_id) == $especialidad->id)>
                    {{ $especialidad->nombre }}
                </option>
            @endforeach
        </select>

        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono"
            value="{{ old('telefono', $medico->telefono) }}" maxlength="20">

        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo"
            value="{{ old('correo', $medico->correo) }}" maxlength="255">

        <label for="activo">Estado *</label>
        <select name="activo" id="activo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="1" @selected((string) old('activo', (int) $medico->activo) === '1')>
                Activo
            </option>
            <option value="0" @selected((string) old('activo', (int) $medico->activo) === '0')>
                Inactivo
            </option>
        </select>

        <button type="submit">Guardar cambios</button>
    </form>
<br>
</main>
</body>
</html>

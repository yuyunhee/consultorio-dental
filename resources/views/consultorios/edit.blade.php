<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar consultorio | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('consultorios.index') }}" class="boton">Volver al listado</a>
      <a href="{{ url('/admin') }}" class="boton1">Administracion</a>
</div>
    </header>
<main class="contenedor-pacientes">
    <h1>Editar consultorio</h1>
    <p style="margin: -10px 0 20px 0; color: #6b7280; font-size: 14px;">Actualiza los datos del consultorio de atención.</p>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('consultorios.update', $consultorio) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre *</label>
        <input id="nombre" name="nombre" value="{{ old('nombre', $consultorio->nombre) }}" required>

        <label for="ubicacion">Ubicación</label>
        <input id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $consultorio->ubicacion) }}">

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion">{{ old('descripcion', $consultorio->descripcion) }}</textarea>

        <label for="activo">Estado *</label>
        <select id="activo" name="activo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="1" @selected((string) old('activo', (int) $consultorio->activo) === '1')>Activo</option>
            <option value="0" @selected((string) old('activo', (int) $consultorio->activo) === '0')>Inactivo</option>
        </select>

        <button type="submit">Guardar cambios</button>
    </form>
<br>
</main>
</body>
</html>

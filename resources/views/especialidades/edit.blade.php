
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar especialidad | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('especialidades.index') }}" class="boton">Volver al listado</a>
     <a href="{{ url('/') }}" class="boton1">Volver al inicio</a>
</div>
    </header>

<main class="contenedor-pacientes">
    <h1>Editar especialidad</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('especialidades.update', $especialidad) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre *</label>
        <input id="nombre" name="nombre"
               value="{{ old('nombre', $especialidad->nombre) }}" required maxlength="100">

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion">{{ old('descripcion', $especialidad->descripcion) }}</textarea>

     <label for="activo">Estado *</label>
        <select name="activo" id="activo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; background-color: #fff;">
            <option value="1" @selected((string) old('activo', (int) $especialidad->activo) === '1')>
                Activo
            </option>
            <option value="0" @selected((string) old('activo', (int) $especialidad->activo) === '0')>
                Inactivo
            </option>
        </select>

        <button type="submit">Guardar cambios</button>
    </form>
</main>
</body>
</html>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva especialidad | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
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
    <h1>Registrar especialidad</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('especialidades.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre *</label>
        <input id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="100">

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>

        <button type="submit">Guardar especialidad</button>
    </form>
</main>
</body>
</html>

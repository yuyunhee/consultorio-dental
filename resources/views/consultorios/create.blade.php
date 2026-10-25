
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar consultorio | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<header class="admin-header">
    <a href="{{ url('/admin') }}" class="logo">Sonrisa Dental</a>
    <a href="{{ route('consultorios.index') }}" class="volver">← Volver a consultorios</a>
</header>

<main class="admin-contenido">
    <section class="admin-bienvenida">
        <h1>Registrar consultorio</h1>
        <p>Completa los datos del espacio de atención.</p>
    </section>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('consultorios.store') }}" method="POST">
        @csrf

        <p>
            <label for="nombre">Nombre del consultorio</label><br>
            <input id="nombre" name="nombre" value="{{ old('nombre') }}"
                   maxlength="100" required>
        </p>

        <p>
            <label for="ubicacion">Ubicación</label><br>
            <input id="ubicacion" name="ubicacion"
                   value="{{ old('ubicacion') }}" maxlength="255">
        </p>

        <p>
            <label for="descripcion">Descripción</label><br>
            <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
        </p>

        <button type="submit">Guardar consultorio</button>
    </form>
</main>
</body>
</html>

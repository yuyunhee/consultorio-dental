
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar paciente | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

 <header class="encabezado">
        <a href="/" class="logo">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
    <a href="{{ route('pacientes.index') }}" class="boton">Volver al listado</a>
     <a href="{{ url('/') }}" class="boton1">Volver al inicio</a>
</div>
    </header>

    <main class="contenedor-pacientes">
        <h1>Registrar paciente</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf

            <label for="nombre">Nombre(s) *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre') }}" required>

            <label for="apellido">Apellidos *</label>
            <input id="apellido" name="apellido" value="{{ old('apellido') }}" required>

            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                   value="{{ old('fecha_nacimiento') }}">

            <label for="telefono">Teléfono *</label>
            <input id="telefono" name="telefono" value="{{ old('telefono') }}" required>

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}">

            <label for="curp">CURP</label>
            <input id="curp" name="curp" maxlength="18" value="{{ old('curp') }}">

            <label for="direccion">Dirección</label>
            <textarea id="direccion" name="direccion">{{ old('direccion') }}</textarea>

            <label for="alergias">Alergias</label>
            <textarea id="alergias" name="alergias">{{ old('alergias') }}</textarea>

            <button type="submit">Guardar paciente</button>
        </form>
<br>
   
    </main>
</body>
</html>

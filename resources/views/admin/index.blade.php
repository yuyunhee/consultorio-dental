<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
     <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

    <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
     <a href="{{ url('/') }}" class="boton1">Volver al inicio</a>
</div>
    </header>
<br>
   <section class="admin-modulos">
    <a href="{{ route('citas.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/calendario.png') }}" alt="Icono Citas" class="modulo-icono-png">
        </div>
        <h2>Gestionar citas</h2>
        <p>Programa, consulta, modifica y cancela citas.</p>
        <span class="modulo-enlace">Administrar →</span>
    </a>

    <a href="{{ route('pacientes.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/paciente.png') }}" alt="Icono Pacientes" class="modulo-icono-png">
        </div>
        <h2>Pacientes</h2>
        <p>Registra pacientes y consulta su historial.</p>
        <span class="modulo-enlace">Administrar →</span>
    </a>

    <a href="{{ route('medicos.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/doctor.png') }}" alt="Icono Médicos" class="modulo-icono-png">
        </div>
        <h2>Médicos</h2>
        <p>Administra los médicos y su estado.</p>
        <span class="modulo-enlace">Administrar →</span>
    </a>

    <a href="{{ route('especialidades.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/especialidad.png') }}" alt="Icono Especialidades" class="modulo-icono-png">
        </div>
        <h2>Especialidades</h2>
        <p>Consulta y administra las especialidades.</p>
        <span class="modulo-enlace">Administrar →</span>
    </a>

    <a href="{{ route('consultorios.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/consultorio.png') }}" alt="Icono Consultorios" class="modulo-icono-png">
        </div>
        <h2>Consultorios</h2>
        <p>Administra los espacios de atención.</p>
        <span class="modulo-enlace">Administrar →</span>
    </a>

    <a href="{{ route('reportes.index') }}" class="modulo">
        <div class="modulo-icono-contenedor">
            <img src="{{ asset('img/iconos/reporte.png') }}" alt="Icono Reportes" class="modulo-icono-png">
        </div>
        <h2>Reportes</h2>
        <p>Consulta las citas por médico y las consultas realizadas.</p>
        <span class="modulo-enlace">Consultar →</span>
    </a>
</section>

    <footer class="admin-footer">
        Sonrisa Dental · Sistema de administración
    </footer>

</body>
</html>

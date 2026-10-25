<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

   <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
   <div class="contenedor-botones">
     <a href="{{ url('/admin') }}" class="boton">Administración</a>
   </div>
    </header>

    <div class="contenedor-panel" style="margin-top: 40px;">
      
        @if (session('success'))
            <div class="alerta-exito">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alerta-exito" style="background-color: #ffeeef; color: #991b1b; border-color: #fca5a5;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alerta-exito" style="background-color: #ffeeef; color: #991b1b; border-color: #fca5a5;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="encabezado-panel">
            <div>
                <h1>Médicos</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">Administra los médicos de la clínica.</p>
            </div>
            <div class="acciones-nav">
                <a href="{{ route('medicos.create') }}" class="boton-pacientes">Registrar médico</a>
            </div>
        </div>

        @if ($medicos->isEmpty())
            <div class="sin-datos">
                <p>Todavía no hay médicos registrados en Sonrisa Dental.</p>
            </div>
        @else
            <table class="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Especialidad</th>
                        <th>Cédula profesional</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicos as $medico)
                        <tr>
                            <td><strong>{{ $medico->nombre }} {{ $medico->apellido }}</strong></td>
                            <td>{{ $medico->especialidad->nombre ?? 'Sin especialidad' }}</td>
                            <td>{{ $medico->cedula_profesional }}</td>
                            <td>{{ $medico->activo ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('medicos.edit', $medico) }}" class="btn-accion btn-editar">Editar</a>
                                    
                                    <form action="{{ route('medicos.destroy', $medico) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este médico?')"
                                          style="display: inline; margin: 0; padding: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-accion" style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</body>
</html>

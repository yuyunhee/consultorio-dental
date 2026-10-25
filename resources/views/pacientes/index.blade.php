<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pacientes | Sonrisa Dental</title>
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

        <div class="encabezado-panel">
            <h1>Listado de Pacientes</h1>
            <div class="acciones-nav">
                <a href="{{ route('pacientes.create') }}" class="boton-pacientes">Registrar paciente</a>
            </div>
        </div>

        @if ($pacientes->isEmpty())
            <div class="sin-datos">
                <p>No hay pacientes registrados todavía en Sonrisa Dental.</p>
            </div>
        @else
            <table class="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td><strong>{{ $paciente->nombre }} {{ $paciente->apellido }}</strong></td>
                            <td>{{ $paciente->telefono }}</td>
                            <td>{{ $paciente->correo ?? 'No registrado' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('pacientes.show', $paciente) }}" class="btn-accion btn-ver">Ver</a>
                                    <a href="{{ route('pacientes.edit', $paciente) }}" class="btn-accion btn-editar">Editar</a>
                                    
                                    <!-- Formulario de eliminación integrado de forma limpia en la tabla -->
                                    <form action="{{ route('pacientes.destroy', $paciente) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Deseas eliminar este paciente?')"
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

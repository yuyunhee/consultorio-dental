<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas | Sonrisa Dental</title>
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
                <h1>Citas médicas</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">Programa y administra las citas de la clínica.</p>
            </div>
            <div class="acciones-nav">
                <a href="{{ route('citas.create') }}" class="boton-pacientes">Agendar cita</a>
            </div>
        </div>

        @if ($citas->isEmpty())
            <div class="sin-datos">
                <p>No hay citas registradas todavía en Sonrisa Dental.</p>
            </div>
        @else
            <table class="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Consultorio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td><strong>{{ $cita->fecha->format('d/m/Y') }}</strong></td>
                            <td>{{ substr($cita->hora_inicio, 0, 5) }}–{{ substr($cita->hora_fin, 0, 5) }}</td>
                            <td>{{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellido ?? '' }}</td>
                            <td>{{ $cita->medico->nombre ?? '' }} {{ $cita->medico->apellido ?? '' }}</td>
                            <td>{{ $cita->consultorio->nombre ?? '—' }}</td>
                            <td>{{ ucfirst($cita->estado) }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('citas.edit', $cita) }}" class="btn-accion btn-editar">Editar</a>
                                    
                                    @if ($cita->estado !== 'cancelada')
                                        <form action="{{ route('citas.destroy', $cita) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Cancelar esta cita?')"
                                              style="display: inline; margin: 0; padding: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-accion" style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif
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

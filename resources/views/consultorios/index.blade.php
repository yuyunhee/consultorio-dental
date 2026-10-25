<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultorios | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

    <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
   <div class="contenedor-botones">
     <a href="{{ url('/admin') }}" class="boton">Administración</a>
   </div>
    </header>

    <div class="contenedor-panel" style="margin-top: 40px; padding: 0 20px;">
      
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
            <div>
                <h1>Consultorios</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">Administra los espacios de atención de la clínica.</p>
            </div>
            <div class="acciones-nav">
                <a href="{{ route('medicos.create') }}" class="boton-pacientes">Registrar consultorio</a>
            </div>
        </div>

        @if ($consultorios->isEmpty())
            <div class="sin-datos">
                <p>Todavía no hay consultorios registrados.</p>
            </div>
        @else
            <table class="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultorios as $consultorio)
                        <tr>
                            <td><strong>{{ $consultorio->nombre }}</strong></td>
                            <td>{{ $consultorio->ubicacion ?: 'No especificada' }}</td>
                            <td>{{ $consultorio->descripcion ?: 'Sin descripción' }}</td>
                            <td>{{ $consultorio->activo ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('consultorios.edit', $consultorio) }}" class="btn-accion btn-editar">Editar</a>

                                    <form action="{{ route('consultorios.destroy', $consultorio) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este consultorio?')"
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

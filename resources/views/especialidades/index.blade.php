
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Especialidades | Sonrisa Dental</title>
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
            <div>
                <h1>Especialidades</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">Administra las especialidades médicas de la clínica.</p>
            </div>
            <div class="acciones-nav">
                <a href="{{ route('especialidades.create') }}" class="boton-pacientes">Registrar especialidad</a>
            </div>
        </div>

        @if ($especialidades->isEmpty())
            <div class="sin-datos">
                <p>Aún no hay especialidades registradas en Sonrisa Dental.</p>
            </div>
        @else
            <table class="tabla-pacientes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($especialidades as $especialidad)
                        <tr>
                            <td><strong>{{ $especialidad->nombre }}</strong></td>
                            <td>{{ $especialidad->descripcion ?: 'Sin descripción' }}</td>
                            <td>{{ $especialidad->activa ? 'Activa' : 'Inactiva' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <a href="{{ route('especialidades.edit', $especialidad) }}" class="btn-accion btn-editar">Editar</a>
                                    
                                    <form action="{{ route('especialidades.destroy', $especialidad) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar esta especialidad?')"
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
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes | Sonrisa Dental</title>
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

        <div class="encabezado-panel">
            <div>
                <h1>Reportes de la clínica</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 14px;">Resumen de citas y actividad de los médicos.</p>
            </div>

        </div>

        <h2 style="font-size: 18px; margin: 30px 0 15px 0; color: #374151;">Resumen general</h2>
        <div class="tarjetas-reporte" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 40px;">
            <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 5px solid #3b82f6;">
                <span style="font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Total de citas</span>
                <p style="font-size: 28px; font-weight: bold; margin: 5px 0 0 0; color: #1f2937;">{{ $totalCitas }}</p>
            </div>
            <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 5px solid #10b981;">
                <span style="font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Programadas</span>
                <p style="font-size: 28px; font-weight: bold; margin: 5px 0 0 0; color: #10b981;">{{ $programadas }}</p>
            </div>
            <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 5px solid #6366f1;">
                <span style="font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Realizadas</span>
                <p style="font-size: 28px; font-weight: bold; margin: 5px 0 0 0; color: #6366f1;">{{ $realizadas }}</p>
            </div>
            <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; border-left: 5px solid #ef4444;">
                <span style="font-size: 13px; color: #6b7280; font-weight: 600; text-transform: uppercase;">Canceladas</span>
                <p style="font-size: 28px; font-weight: bold; margin: 5px 0 0 0; color: #ef4444;">{{ $canceladas }}</p>
            </div>
        </div>

        <h2 style="font-size: 18px; margin: 0 0 15px 0; color: #374151;">Actividad por médico</h2>
        
        @if ($medicos->isEmpty())
            <div class="sin-datos">
                <p>Aún no hay médicos registrados en Sonrisa Dental.</p>
            </div>
        @else
            <div class="lista-medicos" style="display: flex; flex-direction: column; gap: 12px;">
                @foreach ($medicos as $medico)
                    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <strong style="font-size: 16px; color: #111827;">{{ $medico->nombre }} {{ $medico->apellido }}</strong>
                            <span style="display: block; font-size: 13px; color: #6b7280; margin-top: 2px;">
                                Especialidad: {{ $medico->especialidad->nombre ?? 'Sin especialidad' }}
                            </span>
                        </div>
                        <div style="display: flex; gap: 20px;">
                            <div style="text-align: right;">
                                <span style="font-size: 12px; color: #9ca3af; text-transform: uppercase; font-weight: 500;">Total Citas</span>
                                <p style="margin: 0; font-size: 16px; font-weight: 600; color: #374151;">{{ $medico->citas_count }}</p>
                            </div>
                            <div style="text-align: right; border-left: 1px solid #e5e7eb; padding-left: 20px;">
                                <span style="font-size: 12px; color: #9ca3af; text-transform: uppercase; font-weight: 500;">Realizadas</span>
                                <p style="margin: 0; font-size: 16px; font-weight: 600; color: #10b981;">{{ $medico->consultas_realizadas_count }}</p>
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
<br>
    </div>
</body>
</html>

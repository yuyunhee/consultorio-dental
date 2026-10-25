<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cita Agendada | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/agendar.css') }}">
</head>
<body>
    <header>
        <a href="{{ url('/') }}">Sonrisa Dental</a>
        <a href="{{ url('/') }}">Volver al inicio</a>
    </header>

    <main style="text-align: center; max-width: 500px; margin: 60px auto;">
        <div style="font-size: 60px; color: #10b981; margin-bottom: 20px;">✓</div>
        <h1 style="color: #10b981; margin-bottom: 10px;">¡Cita Registrada con Éxito!</h1>
        <p style="color: #4b5563; font-size: 16px; line-height: 1.5; margin-bottom: 30px;">
            Tu espacio ha sido reservado en nuestro sistema. Hemos registrado tus datos y tu horario de atención correctamente.
        </p>

        <a href="{{ url('/') }}" class="select-personalizado" style="display: block; text-align: center; background-color: #2563eb; color: white; text-decoration: none; font-weight: bold; padding: 12px; border-radius: 6px; border: none;">
            Regresar al Inicio
        </a>
    </main>
</body>
</html>

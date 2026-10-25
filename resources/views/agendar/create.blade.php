<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendar cita | Sonrisa Dental</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agendar.css') }}?v={{ time() }}">

</head>
<body>

 <header class="encabezado">
        <a href="/" class="logo"><img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">Sonrisa<span>Dental</span></a>
       <div class="contenedor-botones">
     <a href="{{ url('/') }}" class="boton1">Volver al inicio</a>
</div>
    </header>

    <main>
        <h1>Agenda tu cita</h1>
        <p>Completa tus datos y selecciona cuándo deseas visitarnos.</p>

     <form id="form-agendar" action="{{ route('agendar.store') }}" method="POST">
            @csrf

            <h2>1. Tus datos</h2>

            <label for="nombre">Nombre(s)</label>
            <input type="text" id="nombre" name="nombre" required maxlength="100">

            <label for="apellido">Apellidos</label>
            <input type="text" id="apellido" name="apellido" required maxlength="100">

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" required maxlength="20">

            <label for="correo">Correo electrónico (opcional)</label>
            <input type="email" id="correo" name="correo" maxlength="255">

            <h2>2. Especialidad</h2>

            <label for="especialidad_id">¿Qué atención necesitas?</label>
            <select id="especialidad_id" name="especialidad_id" required>
                <option value="">Selecciona una especialidad</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}">
                        {{ $especialidad->nombre }}
                    </option>
                @endforeach
            </select>

            <h2>3. Fecha y horario</h2>

            <label for="fecha">Fecha de la cita</label>
            <input type="date" id="fecha" name="fecha"
                   min="{{ now()->toDateString() }}" required>

            <label for="hora_inicio">Hora disponible</label>
            <select id="hora_inicio" name="hora_inicio" required disabled>
                <option value="">Primero selecciona especialidad y fecha</option>
            </select>

            <p id="mensaje-horarios" role="status" aria-live="polite"></p>

            <label for="motivo">Motivo de la consulta (opcional)</label>
            <textarea id="motivo" name="motivo" maxlength="1000"></textarea>

             <button type="submit" id="btn-enviar" disabled>
                Confirmar y agendar mi cita
            </button>
        </form>
    </main>

    <script>
        const especialidad = document.getElementById('especialidad_id');
        const fecha = document.getElementById('fecha');
        const hora = document.getElementById('hora_inicio');
        const mensaje = document.getElementById('mensaje-horarios');
        const boton = document.querySelector('button[type="submit"]');

        async function cargarHorarios() {
            hora.innerHTML = '<option value="">Cargando horarios...</option>';
            hora.disabled = true;
            boton.disabled = true;
            mensaje.textContent = '';

            if (!especialidad.value || !fecha.value) {
                hora.innerHTML = '<option value="">Selecciona especialidad y fecha</option>';
                return;
            }

            try {
                const parametros = new URLSearchParams({
                    especialidad_id: especialidad.value,
                    fecha: fecha.value
                });

                const respuesta = await fetch(
                    `{{ route('agendar.horarios') }}?${parametros}`
                );

                if (!respuesta.ok) {
                    throw new Error('No se pudieron consultar los horarios.');
                }

                const horarios = await respuesta.json();
                hora.innerHTML = '';

                if (horarios.length === 0) {
                    hora.innerHTML = '<option value="">Sin horarios disponibles</option>';
                    mensaje.textContent = 'No hay horarios disponibles para esa fecha. Prueba con otro día.';
                    return;
                }

                hora.add(new Option('Selecciona una hora', ''));

                horarios.forEach((horario) => {
                    hora.add(new Option(
                        `${horario.hora_inicio} - ${horario.hora_fin}`,
                        horario.hora_inicio
                    ));
                });

                hora.disabled = false;
                mensaje.textContent = 'Selecciona uno de los horarios disponibles.';
            } catch (error) {
                hora.innerHTML = '<option value="">Error al cargar horarios</option>';
                mensaje.textContent = 'No pudimos consultar los horarios. Intenta nuevamente.';
            }
        }

         especialidad.addEventListener('change', cargarHorarios);
        fecha.addEventListener('change', cargarHorarios);

        hora.addEventListener('change', () => {
            boton.disabled = !hora.value;
        });

        document.getElementById('form-agendar').addEventListener('submit', () => {
            document.getElementById('btn-enviar').innerText = 'Procesando tu cita...';
        });
    </script>
</body>
</html>
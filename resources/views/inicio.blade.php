
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonrisa Dental | Consultorio Dental</title>

    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>

    <header class="encabezado">
        <a href="" class="logo">
    <img src="{{ asset('img/cepillo.png') }}" alt="Logo Sonrisa Dental" style="width: 20px; height: 20px; vertical-align: middle;">
    Sonrisa<span>Dental</span>
</a>


        <nav class="navegacion">
            <a href="#inicio">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#nosotros">Nosotros</a>
            <a href="#contacto">Contacto</a>

        </nav>

       <div class="contenedor-botones">
    <a href="{{ route('agendar.create') }}" class="boton boton-nav">Agendar cita</a>
        <a href="{{ route('admin.index') }}" class="acceso-admin"aria-label="Abrir administración" title="Administración">⚙</a>


    </header>

    <main>
        <section class="hero" id="inicio">
            <div class="hero-contenido">
                <p class="etiqueta">TU SONRISA ES NUESTRA PRIORIDAD</p>

                <h1>Una sonrisa sana comienza con el cuidado adecuado.</h1>

                <p class="hero-descripcion">
                    Cuidamos tu salud bucal con atención profesional,
                    tecnología y un trato amable para toda la familia.
                </p>

                <div class="hero-botones">
                    <a href="{{ route('agendar.create') }}" class="boton">Agenda tu cita</a>
                    <a href="#servicios" class="boton boton-secundario">
                        Conoce nuestros servicios
                    </a>
                </div>

                <p class="hero-nota">
                    Atención personalizada · Cuidado profesional
                </p>
            </div>

            <div class="hero-visual">
                <div class="tarjeta-sonrisa">
                    <img src="{{ asset('img/diente.png') }}" alt="Consultorio dental" width="50%" height="50%">
                    <p>Tu salud bucal importa</p>
                    <span>Estamos aquí para cuidarte.</span>
                </div>
            </div>
        </section>

        <section class="seccion servicios" id="servicios">
            <div class="titulo-seccion">
                <p class="etiqueta">¿CÓMO PODEMOS AYUDARTE?</p>
                <h2>Nuestros servicios</h2>
                <p>Cuidado dental pensado para ti.</p>
            </div>

            <div class="servicios-grid">
                <article class="servicio">
                    <span class="servicio-icono">01</span>
                    <h3>Limpieza dental</h3>
                    <p>Cuida tus dientes y encías con una limpieza profesional.</p>
                </article>

                <article class="servicio">
                    <span class="servicio-icono">02</span>
                    <h3>Revisión general</h3>
                    <p>Revisamos tu salud bucal y te orientamos sobre sus cuidados.</p>
                </article>

                <article class="servicio">
                    <span class="servicio-icono">03</span>
                    <h3>Ortodoncia</h3>
                    <p>Conoce las opciones para corregir la posición de tus dientes.</p>
                </article>
            </div>
        </section>

        <section class="seccion nosotros" id="nosotros">
            <p class="etiqueta">SOBRE NOSOTROS</p>
            <h2>Tu tranquilidad también es parte de tu sonrisa.</h2>
            <p>
                Queremos que cada visita sea una experiencia cómoda,
                cercana y enfocada en tus necesidades.
            </p>
        </section>

        <section class="seccion cita" id="citas">
            <div>
                <p class="etiqueta">ESTAMOS PARA AYUDARTE</p>
                <h2>¿Listo para cuidar tu sonrisa?</h2>
                <p>Contáctanos para solicitar una cita.</p>
            </div>

            <a href="#contacto" class="boton">Solicitar información</a>
        </section>
    </main>
<br>



    <footer id="contacto">
        <a href="/" class="logo">Sonrisa<span>Dental</span></a>
        <p>Tu salud bucal, en buenas manos.</p>
        <p class="copyright">© {{ date('Y') }} Sonrisa Dental</p>
    </footer>

</body>
</html>

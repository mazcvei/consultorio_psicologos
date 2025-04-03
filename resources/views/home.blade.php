@extends('layouts.app')
@section('post-head')
<style>
    #map {
        height: 490px;
        width: 100%;
        border-radius: 8px;
        z-index: 1;
    }

    .input-group {
        margin-bottom: 8px;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div id="carruselHome" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselHome" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carruselHome" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carruselHome" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/s2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-md-block">
                        <h5>Ansiedad y depresión</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/s1.jpg" class="d-block w-100" alt="imagen-hierbas">
                    <div class="carousel-caption d-md-block">
                        <h5>Foto 2</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/s3.jpg" class="d-block w-100" alt="imagen-hierbas">
                    <div class="carousel-caption d-md-block">
                        <h5>Foto 3</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carruselHome" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselHome" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<div class="container">
    <div class="row seccion1">
        @if (session('success'))
        <div class="col-12 mt-3">
            <div class="alert alert-success" style="text-align: center">
                <h3>{{session('success')}}</h3>
            </div>
        </div>
        @endif
        <div class="col-md-4"><img class="img-about" src="images/principal.png" alt="img-principal"></div>
        <div class="col-md-8">
            <div class="row">

                <h1 class="title">¿Quiénes somos?</h1>
                <p>En nuestro centro de psicología, contamos con un equipo de psicólogos y psicólogas altamente
                    cualificados y en constante formación. Nos especializamos en diversas áreas de la salud mental
                    para ofrecerte un enfoque integral y personalizado, adaptado a tus necesidades específicas.
                    Creemos firmemente en la importancia de la actualización continua, lo que nos permite aplicar
                    las metodologías más innovadoras y eficaces en cada caso.

                    Nuestra intervención se basa en técnicas respaldadas por la evidencia científica y validadas en
                    el ámbito clínico. No obstante, más allá del rigor profesional, nos distingue nuestra calidad
                    humana: entendemos que cada persona es única y merece un acompañamiento cercano, respetuoso y
                    empático. Nuestro compromiso es brindarte un espacio seguro, donde puedas expresarte con
                    libertad y sin juicios, facilitando así tu proceso de cambio y crecimiento personal.

                    Trabajamos para proporcionarte herramientas que te ayuden a gestionar tus emociones, superar
                    dificultades y alcanzar el bienestar psicológico que mereces. Ya sea que estés enfrentando
                    momentos de crisis, dificultades emocionales o simplemente desees potenciar tu desarrollo
                    personal, estamos aquí para apoyarte en cada paso del camino.

                    <strong>Recuperar tu equilibrio emocional es posible. Déjanos acompañarte en este proceso con
                        profesionalismo, dedicación y compromiso</strong>
                </p>


            </div>
        </div>
    </div>

    <div class="container-fluid section3">
        <div class="row">
            <div class="col-12">
                <h1 class="title mb-4 mt-4"><span class="color-titulo">Nuestras</span> Especialidades</h1>
                <p style="text-align: center">Nos especializamos en tratar una variedad de problemas emocionales y
                    psicológicos para ayudarte a
                    sentirte mejor y vivir una vida más plena. Algunas de nuestras especialidades son:
                </p>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="subtitle">Ansiedad y Depresión</h2>
                        <p>La ansiedad y la depresión se manifiestan de manera diferente en cada persona. Trabajamos de
                            manera específica para reducir la rumiación, los pensamientos negativos y afrontar
                            situaciones que se tienden a evitar.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="subtitle">Autoestima e Inseguridad</h2>
                        <p>Ayudamos a cuidarte y crecer, a sentirte bien contigo mismo, libre de miedos y limitaciones.
                            Estos aspectos son esenciales para el bienestar y nuestra salud emocional.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-10">
                        <h2 class="subtitle">Manejo del Estrés</h2>
                        <p>Enseñamos técnicas para manejar el estrés de manera efectiva, ayudándote a encontrar
                            equilibrio y bienestar en tu vida diaria.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-10">
                        <h2 class="subtitle">Relaciones de Pareja</h2>
                        <p>Abordamos problemas de relaciones tanto en terapia de pareja como de manera individual.
                            Tratamos la falta de confianza, el desarrollo de dinámicas positivas y la comunicación
                            efectiva</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid section4 mt-4" id="contacto">
        <div class="row">

            <div class="col-12">
                <h1 class="title mb-4 mt-4"><span class="color-titulo">Contáctanos</span></h1>
            </div>
            <div class="col-12 col-md-6">
                <form method="POST" action="{{route('contact.send')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input required type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input required type="text" name="email" class="form-control" id="email" value="{{old('email')}}">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Servicios que te interesan: </label>
                            @foreach(\App\Models\Service::all() as $service)
                            <div class="input-group">
                                <input type="checkbox" class="m-2" name="services[{{$service->title}}]" />
                                <label>{{$service->title}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3 col-md-12">
                            <input required type="checkbox" class="m-2" name="terms" />
                            <label>He leído y acepto el <span style="cursor: pointer; font-weight :bold"
                                    onclick="document.getElementById('myDialog').showModal()"> Aviso Legal y la Política
                                    de Privacidad </span></label>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea required rows="3" class="form-control" id="message" name="message_text"></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-info">Enviar</button>
                    <button type="reset" class="btn btn-black">Limpiar formulario</button>

                </form>
                 <!-- Modal -->
                 <dialog id="myDialog">
                    <h5>INFORMACIÓN BÁSICA SOBRE PROTECCIÓN DE DATOS</h5>
                    <p>Responsable: Antonio López.</p>

                    <p> Finalidad: Gestión de consultas sobre los servicios del centro de Psicología (tramitar
                        encargos, solicitudes, dar respuesta a las consultas o cualquier petición que sea realizada
                        por el USUARIO a través del formulario de contacto que se pone a disposición en la página
                        web del RESPONSABLE y enviar comunicaciones de productos o servicios)</p>
                    </p>
                    <p> Legitimación: Consentimiento del interesado.</p>

                    <p> Destinatarios: Los datos no serán cedidos a terceros ajenos a la empresa.</p>

                    <p>Derechos: Tiene derecho a acceder, rectificar y suprimir los datos, así como otros derechos,
                    como se explica en la información adicional.
                    </p>

                    <!-- Botón para cerrar el modal (usa formmethod="dialog") -->
                    <form method="dialog">
                        <button type="submit" class="btn btn-black">Cerrar</button>
                    </form>
                </dialog>
            </div>
            <div class="col-12 col-md-6">
                <div tabindex="650" id="map"></div>
            </div>

        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
     
        const mapElement = document.getElementById('map');
        
        if (mapElement) {
            const latitud = 36.465572;
            const longitud = -6.193906;
            var map = L.map('map').setView([latitud, longitud], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);
            
            // Marcador con popup
            L.marker([latitud, longitud]).addTo(map)
                .bindPopup('<b>¡Hola!</b><br>Estamos aquí.')
                .openPopup();
        } else {
            console.error('Elemento con ID "map" no encontrado');
        }
    });
</script>

@endsection
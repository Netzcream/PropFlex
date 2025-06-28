@extends('layouts.public')

@section('title', 'Quienes somos')

@section('content')
    <section class="max-w-6xl mx-auto px-4 pt-24 pb-8 text-center">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-4">Conocé PropFlex</h1>
        <p class="text-lg text-gray-600">
            Somos una inmobiliaria comprometida con brindar un servicio transparente, humano y profesional. Conocé nuestra
            historia, valores y el equipo que te acompaña en cada paso.
        </p>
    </section>




    <section class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-4 py-16 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-4">Comprometidos con tu próximo hogar</h2>
            <p class="text-lg">
                En <strong>PropFlex</strong> trabajamos todos los días para acercarte a esa propiedad que estás buscando. Ya
                sea para vivir, invertir o comenzar un nuevo proyecto, nuestro objetivo es acompañarte con honestidad,
                dedicación y asesoramiento personalizado.
            </p>
        </div>
        <div>
            <img src="img/about/oficina.png" alt="Equipo trabajando en oficina"
                class="w-full h-72 object-cover object-center rounded-lg shadow-lg img-blur" loading="lazy">
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-4 items-center">
            <div>
                <img src="img/about/mision.png" alt="Agente inmobiliario trabajando"
                    class="w-full h-72 object-cover object-center rounded-lg shadow-lg img-blur" loading="lazy">
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Nuestra misión</h2>
                <p class="text-lg mb-4">
                    Brindar un servicio inmobiliario confiable, transparente y cercano, ayudando a cada cliente a tomar
                    decisiones seguras en momentos clave de su vida.
                </p>
                <h2 class="text-3xl font-bold mb-4 mt-8">Nuestra visión</h2>
                <p class="text-lg">
                    Ser una inmobiliaria de referencia en el mercado local, destacándonos por el trato humano, la eficiencia
                    en los procesos y el conocimiento profundo del sector.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-4 py-16 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-4">Nuestro equipo</h2>
            <p class="text-lg">
                Somos personas que entendemos que detrás de cada propiedad hay un sueño. Nuestro equipo combina experiencia
                en el mercado con calidez humana para acompañarte con empatía y compromiso durante todo el proceso de
                compra, venta o alquiler.
            </p>
        </div>
        <div>


            <img src="img/about/equipo.png" alt="Equipo de PropFlex"
                class="w-full h-72 object-cover object-center rounded-lg shadow-lg img-blur" loading="lazy">
        </div>
    </section>


    <section class="bg-white py-12">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-4 text-center">
            <div>
                <img src="img/icons/handshake.svg" class="w-12 mx-auto mb-4" alt="">
                <h3 class="text-xl font-semibold mb-2">Confianza</h3>
                <p class="text-sm text-gray-600">Nos esforzamos por generar vínculos honestos y duraderos con cada cliente.
                </p>
            </div>
            <div>
                <img src="img/icons/users.svg" class="w-12 mx-auto mb-4" alt="">
                <h3 class="text-xl font-semibold mb-2">Cercanía</h3>
                <p class="text-sm text-gray-600">Estamos para escucharte y acompañarte en cada decisión.</p>
            </div>
            <div>
                <img src="img/icons/square-check.svg" class="w-12 mx-auto mb-4" alt="">
                <h3 class="text-xl font-semibold mb-2">Compromiso</h3>
                <p class="text-sm text-gray-600">Nos tomamos en serio cada búsqueda, como si fuera propia.</p>
            </div>
        </div>
    </section>

@endsection

@extends('layouts.main-frontend')
@section('main-content')


<!-- MENÚ DEL DÍA -->
  <div class="row">
      <section name="menu del día">
        <header>
        <span class="text-center"><h1 class="lobster primary-color">Menú del día</h1></span>
        </header>

        <article>

          <div class="row margin-top-row">
            @foreach($productosDia as $producto)
                <div class="col-md-offset-1 col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                          <h2 class="panel-title">{{$producto->nombre}}</h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Marca: </strong> {{$producto->proveedor}}</p>
                          <p> <strong> Precio: </strong> {{$producto->precio_venta_unitario}}</p>
                        </div>
                      </div>
                    </div>
                  <div class="col-md-1"></div>
            @endforeach
        @if (count($productosDia) == 0)
                <span class="text-center"><h3 class="lobster gray-color">Todavía no elegimos el menú para hoy. Volvé pronto.</h3></span>
        @endif

          </div>

        </article>
      </section>
  </div>

<!--
<div class="col-md-offset-1 col-md-10">
<div class="h-divider"></div>
</div>
-->

<!-- DESCRIPCIÓN DEL BUFFET -->
<section name="home">
    <div class="row">

          <head>
            <h1 class="lobster primary-color text-center">Bienvenido a su segundo hogar</h1>
          </head>

          <div class="row margin-top-row">
              <div class="col-md-offset-1 col-md-10">
                  <div class="text-center">
                    <img src=imgs/facu.JPG class="home-img">
                  </div>
                  <p class="margin-top-row">El buffet de la Facultad de Informática está pensado como un espacio de esparcimiento para los estudiantes. Cuenta con ambiente climatizado (aire frío-calor, calefactores, ventiladores) y con las prestaciones de conexiones de red de la Facultad. Tiene metegoles para los tiempos libres, pero también puede constituirse en una cálida sala de estudios.</p>

                  <p>Posee, asimismo,  becas para estudiantes (exclusivamente de la FI) que necesiten trabajar. Aquellos interesados concurrir al directamente al Buffet.</p>
              </div>
          </div>
          <div class="row margin-top-row">
              <div class="col-md-offset-1 col-md-10">
                  <div class="col-md-4">
                    <div class="text-center gray-color">
                      <p><h1><i class="fa fa-clock-o fa-3x"></i></h1></p>
                      <p><h3 class="bold">Horario de atencion</h3></p>
                    </div>
                      <p>El buffet es gestionado por el Centro de Estudiantes y está abierto de 8 a 20 hs. Tiene servicio de cafetería y matería (facilitan el préstamo de equipos de mate), así como agua caliente gratuita.</p>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center gray-color">
                      <p><h1><i class="fa fa-gamepad fa-3x"></i></h1></p>
                      <p><h3 class="bold">Entretenimiento</h3></p>
                    </div>
                    <p>El buffet no solo está destinado para que los miembros de la facultad vayan a comer, sino que también disponemos instalaciones para que puedas entrenerte y despejar tu cabeza del estudio. Tenemos televisión, metegol y mesa de ping-pong para que puedas venir a relajarte con tus compañeros. </p>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center gray-color">
                      <p><h1><i class="fa fa-money fa-3x"></i></h1></p>
                      <p><h3 class="bold">Excelentes precios</h3></p>
                    </div>
                    <p>Una de nuestras prioridades es ofrecer excelencia de productos y servicios al menor coste posible. Disponemos de excelentes precios para los miembros de la Facultad. También ofrecemos precios especiales a los alumnos que son becados tanto por la Facultad de Informática como por el CEFI.  </p>
                  </div>
              </div>
          </div>
    </div>

  <h2></h2>

</section>

<div class="col-md-offset-1 col-md-10">
<div class="h-divider"></div>
</div>


<!-- JUMBOTRON -->
<section name="anuncio registrarse">
    <article>
              <div class="row">
                 <div class="col-md-offset-1 col-md-10">
                      <div class="jumbotron margin-top-row">
                        <div class="row">
                          <div class="col-md-8">
                            <h1 class="lobster primary-color">Sumate al Buffet!</h1>
                            <p>Registrarte al Buffet como un usario te permite hacer pedidos y que te los llevemos a tu lugar de trabajo dentro del campus universitario.</p>
                            <p> <h5>Requisito único: trabajar en la Facultad.</h5> </p>
                            <div class="text-center">
                              <br>
                              <p><a class="btn btn-primary btn-lg" href="/register" role="button">Registrarse</a></p>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <img src="imgs/buffet-fuera.png" class="img-rounded img-jumbotron">
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
    </article>
</section>

@endsection

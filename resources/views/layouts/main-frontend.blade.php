<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ Setting::get('nombre') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="icon" type="image/png" href="/imgs/logo-info.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link href="/css/main-frontend.css" rel="stylesheet">
    @section('head')
    @show
  </head>
  <body>

  <!-- Header Logo -->
    <header>
      <div class="container-fluid header">
        <div class="row">
          <div class="col-md-9 col-md-offset-3">
            <a href="/">
                <img src="/imgs/banner.png" class="width-ext">
            </a>
          </div>
        </div>
      </div>
    </header>



    <!-- Navigation-->
    <div class="container-fluid">
      <div class="col-md-offset-1 col-md-10">
        <nav class="navbar navbar-default">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ Setting::get('nombre') }}</a>
            @if (Auth::user())
              <a class="navbar-brand" href="/"> Hola, {{ Auth::user()->usuario }}</a>
            @endif
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav">
           
             @if (Auth::user() == null) <!-- Ingreso y registro si no está logeado -->
                <li><a href="{{ url('/login') }}">Ingresar <span class="sr-only"></span></a></li> 
                <li><a href="{{ url('/register') }}">Registrarse</a></li>
             @endif

             @if (Auth::user() && Auth::user()->rol->id < 3) <!-- Menu de administrador o empleado -->
                 <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                     <li><a href="/productos/">Control de productos</a></li>
                     <li><a href="/ventas/">Control de ventas</a></li>
                     <li><a href="/compras">Control de compras</a></li>
                     @if (Auth::user()->rol->nombre == 'administrador')
                        <li role="separator" class="divider">Administración</li>
                     @endif 
                   </ul>
                 </li>

                 <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Control de pedidos <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                     <li><a href="/menus/">Administrar menú del día</a></li>
                     <li><a href="/pedidos/">Ver pedidos</a></li>
                   </ul>
                 </li>
                
                @if (Auth::user()->rol->nombre == 'administrador')
                        <li><a href="/usuarios">Control de usuarios</a></li>
                        <li><a href="/configuracion/editar">Configuracion</a></li>
                        <li><a href="/balance">Balance</a></li>
                @endif
               @endif

                @if (Auth::user() && Auth::user()->rol->nombre == 'usuario')
                        <li><a href="/pedidos/create">Hacer pedido</a></li>
                        <li><a href="/{{Auth::user()->slug}}/pedidos">Ver pedidos realizados</a></li>
                @endif

              <li><a href="/about">Acerca de</a></li>

              @if (Auth::user()) <!-- Salir -->
                      <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                           <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                          </form>
                     </li>
              @endif
           </ul>
         </div>

  </nav>


<!-- section -->

@section('main-content')
@show


      <!-- Footer -->
          <footer class="text-center">
              <div class="footer-above">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="footer-col col-md-4">
                              <h3>Contacto</h3>
                              <p>Centro de Estudiantes,
                                  <br>Facultad de Informática</p>
                          </div>
                          <div class="footer-col col-md-4 col-md-offset-3">
                              <h3>Visitanos</h3>
                              <ul class="list-inline">
                                  <li>
                                      <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                                  </li>
                                  <li>
                                      <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                                  </li>
                                  <li>
                                      <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                                  </li>
                                  <li>
                                      <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="footer-below">
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-12">
                              {{ Setting::get('nombre') }} &copy; @section('footing')Informática UNLP 2016 @show
                          </div>
                      </div>
                  </div>
              </div>
          </footer>
        </div>
      </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    @section('script-footer')
    @show

    </script>
  </body>

</html>

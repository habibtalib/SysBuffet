@extends('layouts.main-frontend')
@section('main-content')

<!-- Listado -->
<div class="container-fluid">
    <div class="col-md-offset-1 col-md-10">
      <section name="listado">
        <header>
        <span class="text-center"><h1 class="lobster primary-color">@yield('titulo')</h1></span>

		@if(!isset($noMostrar))
          <div class="text-center"><a class="btn btn-info btn input-margin-sm" href="@yield('insertar-link')" role="button">Agregar</a></div>
        @endif
        <div class="col-md-10 col-md-offset-1">
              @section('orden')
              @show      
        </div>
        </header>

        <article>
          <div class="col-md-10 col-md-offset-1">
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
          </div>

          @yield('mostrar-items')

          <div class="text-center">
            {{ $items->links() }}
          </div>

          <div class="text-center input-margin">
              <a class="btn btn-warning" href="/home"> Regresar </a>
          </div>

          @section('extra')
          @show

        </item>
      </section>
    </div>
</div>

<!-- Eliminar !-->
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="loginModalLabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Confirmar baja </h4>
            </div>
            <div class="modal-body">
                <h4 class="gray-color">¿Esta seguro que desea eliminar el item seleccionado?</h4>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-danger" id="error-message" role="alert"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <span class="bold"> Error! </span> No se ha podido dar de baja el item seleccionado. Intente más tarde.</div>
                    <div class="alert alert-success" id="success-message" role="alert"><span class="glyphicon glyphicon-warning-ok" aria-hidden="true"></span> <span class="bold"> Éxito! </span> El item se ha dado de baja exitosamente!</div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Cancelar</button>
              <button type="button" class="btn btn-danger" id='btn-token' data-token="{{ csrf_token() }}" onclick="eliminarItem()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="/js/eliminar.js">
</script>



@endsection

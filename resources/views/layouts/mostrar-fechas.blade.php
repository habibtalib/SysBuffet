@section('head')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection
@extends('layouts.main-frontend')
@section('main-content')

<div class="panel panel-success">
    <div class="panel-heading bold">
      <h3 class="panel-title bold">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>   @yield('titulo')
      </h3>
    </div>
    <div class="panel-body">
      <div class="col-md-offset-1 col-md-10">

        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <h3 class="text-centered lobster primary-color">Seleccione las fechas para @yield('accion')</h3>

        @section('formulario-fechas')
        @show

      </div>
    </div>
</div>

@endsection
@section('script-footer')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $( function() {
          $( "#datepicker" ).datepicker();
          $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
          $( "#datepicker1" ).datepicker();
          $( "#datepicker1" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
        } );

  </script>
@endsection
@extends('layouts.main-frontend')
@section('head')
    <script src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="/js/highcharts.js"></script>
     <script src="/js/exporting.js"></script>

@endsection
@section('main-content')

<div class="panel panel-success">
    <div class="panel-heading bold">
      <h3 class="panel-title bold">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Balances entre fechas {{$fecha_inicio}} y {{$fecha_fin}}
      </h3>
    </div>
    <div class="panel-body">

      <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h3 class="text-centered lobster primary-color input-margin">Las ganacias por día</h3>

            <table class="table table-bordered" id="productosComprados">
                      <tr class="warning-color">
                        <th>Día</th>
                        <th>Balance</th>
                      </tr>
                        @foreach ($balances['fechas'] as $key => $balancePorEstaFecha)
                          <tr class="table-gray">
                            <th>{{$key}}</th>
                            <th>{{$balancePorEstaFecha}}$</th>
                          </tr> 
                        @endforeach
            </table>
        </div>
      </div>

      <div class="row">
          <div id="grafico" class="col-md-offset-1 col-md-10 text-center">
                <a class="btn btn-success input-margin text-center" role="button" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1"> Mostrar gráfico </a>
                <div class="collapse" id="collapse1">
                  <div class="well">
                    <div id="containerFechas" >Hola</div>
                  </div>
                </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-offset-1 col-md-10 margin-top-md">
            <div class="h-divider"></div>
          </div>
      </div>

      <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h3 class="text-centered lobster primary-color input-margin">Las ventas por producto</h3>

            <table class="table table-bordered" id="productosComprados">
                      <tr class="warning-color">
                        <th>Nombre del producto</th>
                        <th>Ingresos</th>
                      </tr>
                        @foreach ($balances['productos'] as $balancePorEstaFecha)
                          <tr class="table-gray">
                            <th>{{$balancePorEstaFecha['nombre']}}</th>
                            <th>{{$balancePorEstaFecha['sum(precio_total)']}}</th>
                          </tr> 
                        @endforeach
            </table>

            
        </div>
      </div>
    
    <div class="row">
      <div id="grafico" class="col-md-offset-1 col-md-10 text-center">
            <a class="btn btn-success input-margin text-center" role="button" data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapse2"> Mostrar gráfico </a>
            <div class="collapse" id="collapse2">
              <div class="well">
                <div id="containerProductos" ></div>
              </div>
            </div>
      </div>
    </div>

      <div class="text-center input-margin">
        <a class="btn btn-warning" href="/home"> Regresar </a>
      </div>

    </div>
</div>
@endsection
@include('balance.logica-balance')
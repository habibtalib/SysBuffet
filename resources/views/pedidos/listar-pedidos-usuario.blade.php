@extends('layouts.listar-items')
@section('head')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection
@section('titulo', 'Pedidos')
@section('insertar-link','/pedidos/create')



@section('mostrar-items')

  @foreach ($items as $item)
    <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                          <h2 class="panel-title">
                          <span id="title">Pedido #{{$item->id}}, de {{$item->usuario->usuario}}</span>
                          <a href="/pedidos/{{$item->id}}/editar"><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Nombre: </strong> {{ $item->usuario->nombre }} </p>
                          <p> <strong> Fecha del pedido: </strong> {{ $item->fecha}} </p>
                          <p> <strong> Fecha: </strong> {{ $item->fecha }} </p>
                          <p> <strong> Estado: </strong>
                                              @if($item->estado->nombre  == 'pendiente')
                                                <span class="label label-info"> {{$item->estado->nombre}}
                                              @elseif($item->estado->nombre == 'entregado')
                                                <span class="label label-success"> {{$item->estado->nombre}}
                                              @elseif($item->estado->nombre == 'cancelado')
                                                <span class="label label-danger"> {{$item->estado->nombre}} 
                                                </span> </p>
                                                @if(!empty($item->observacion)) <p> <strong> Motivo de rechazo: </strong>  {{$item->observacion}}</p>
                                                @endif
                                              @endif


                           <ul class="list-group">
                            @foreach ($item->productosPedidos as $detalle)
                              <li class="list-group-item"> 
                                <p> Nombre: {{ $detalle->nombre}} </p>
                                <p> Marca: {{ $detalle->marca}} </p>
                                <p> Cantidad: {{ $detalle->pivot->cantidad }} </p>
                            @endforeach
                          </ul>
                        </div>
                    </div>
                </div>
      </div>
    @endforeach
@endsection

@section('extra')
    <div class="col-md-10 col-md-offset-1">
          <p><h3 class="gray-color">Ver pedidos entre: </h3></p>
          {!! Form::open(['url' => '/'.Auth::user()->slug.'/pedidos/filtrarFechas']) !!}

              <div class="form-group input-margin primary-color">
                  {!! Form::label('fecha_inicio', 'Desde') !!}
                  {!! Form::text('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Presione aqui para desplegar las fechas', 'id' => 'datepicker1']) !!}
               </div>

               <div class="form-group primary-color">
                  {!! Form::label('fecha_fin', 'Hasta') !!}
                  {!! Form::text('fecha_fin', null, ['class' => 'form-control', 'placeholder' => 'Presione aqui para desplegar las fechas', 'id' => 'datepicker2']) !!}
               </div>
                <div class="text-center input-margin">
                    {!! Form::button('Enviar datos', ['class' => 'btn-sm btn-danger', 'type' => 'submit']) !!}
                 </div>
          {!! Form::close() !!}
     </div>
@endsection

@section('script-footer')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
              $( "#datepicker1" ).datepicker();
              $( "#datepicker1" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
              $( "#datepicker2" ).datepicker();
              $( "#datepicker2" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
            } );
        </script>
@endsection
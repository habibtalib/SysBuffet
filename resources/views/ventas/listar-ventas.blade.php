@extends('layouts.listar-items')
@section('titulo', 'Ventas')
@section('insertar-link','/ventas/create')

@section('orden')
 <div class="btn-group margin-bot-sm text-center">
          <button type="button" class="text-center btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="/ventas/cantidad/ordenar">Cantidad</a></li>
            <li><a href="/ventas/precio_total/ordenar">Precio total</a></li>
            <li><a href="/ventas/fecha/ordenar">Fecha</a></li>
          </ul>
 </div>
@endsection

@section('mostrar-items')
  @foreach ($items as $item)
    <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                          <h2 class="panel-title">
                          <span id="title">Venta de {{ $item->producto->nombre}} {{ $item->producto->marca}}</span>
                          <a href="/ventas/{{$item->id}}/edit"><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>
                          <span class="pull-right"> | | </span>
                          <a href="#" onclick='eliminar("ventas", "{{$item->id}}")'><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Cantidad: </strong> <span>{{ $item->cantidad }}</span></p>
                          <p> <strong> Precio total: </strong> <span>{{ $item->precio_total }}$</span></p>
                          <p> <strong> Fecha: </strong> <span>{{ $item->fecha }}</span></p>
                          @if($item->descripcion != NULL)
                              <p> <strong> Descripción: </strong> <span>{{ $item->descripcion }}</span></p>
                          @endif
                        </div>
                    </div>
                </div>
      </div>
    @endforeach
@endsection

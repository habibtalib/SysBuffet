@extends('layouts.listar-items')
@section('titulo', 'Compras')
@section('insertar-link','/compras/create')

@section('orden')
 <div class="btn-group margin-bot-sm text-center">
          <button type="button" class="text-center btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="/compras/cuit_proveedor/ordenar">CUIT del proveedor</a></li>
            <li><a href="/compras/proveedor/ordenar">Nombre del proveedor</a></li>
            <li><a href="/compras/fecha/ordenar">Fecha de compra</a></li>
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
                          <span id="title">Compra #{{$item->id}}</span>
                          <a href="/compras/{{$item->id}}/edit"><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>
                          <span class="pull-right"> | | </span>
                          <a href="#" onclick='eliminar("compras", "{{$item->id}}")'><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          @if ($item->factura != null)
                            <a class="center-block" href="/compras/{{$item->id}}/mostrarFactura"> Ver factura </a>
                          @endif
                          <p> <strong> CUIT del proveedor: </strong> {{ $item->cuit_proveedor }} </p>
                          <p> <strong> Proveedor: </strong> {{ $item->proveedor}} </p>
                          <p> <strong> Fecha: </strong> {{ $item->fecha}} </p>
                          <p> <strong> Productos comprados: </strong></p>
                           <ul class="list-group">
                            @foreach ($item->detalles as $detalle)
                              <li class="list-group-item"> 
                                <p> Nombre: {{ $detalle->producto->nombre}} </p>
                                <p> Marca: {{ $detalle->producto->marca}} </p>
                                <p> Cantidad: {{ $detalle->cantidad}} </p>
                                <p>  Precio total de la venta:  {{ $detalle->precio_total}} </p>
                            @endforeach
                          </ul>
                        </div>
                    </div>
                </div>
      </div>
    @endforeach
@endsection
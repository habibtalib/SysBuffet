@extends('layouts.listar-items')
@section('titulo', 'Productos')
@section('insertar-link','/productos/create')

@section('orden')
 <div class="btn-group margin-bot-sm text-center">
          <button type="button" class="text-center btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="/productos/marca/ordenar">Marca</a></li>
            <li><a href="/productos/descripcion/ordenar">Descripción</a></li>
            <li><a href="/productos/proveedor/ordenar">Proveedor</a></li>
            <li><a href="/productos/precio_venta_unitario/ordenar">Precio de venta unitario</a></li>
            <li><a href="/productos/stock/ordenar">Stock</a></li>
            <li><a href="/productos/stock_minimo/ordenar">Debajo del stock mínimo</a></li>
            <li><a href="/productos/codigo_barras/ordenar">Código de barras</a></li>
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
                          <span id="title">{{ $item->nombre }}</span>
                          <a href="/productos/{{$item->slug}}/edit"><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>
                          <span class="pull-right"> | | </span>
                          <a href="#" onclick='eliminar("productos", "{{$item->slug}}")'><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Marca: </strong> <span id="content{{$item->id}}">{{ $item->marca }}</span></p>
                          <p> <strong> Descripción: </strong> {{ $item->descripcion }} </p>
                          <p> <strong> Categoría: </strong> {{ $item->categoria->nombre}} </p>
                          <p> <strong> Proveedor: </strong> {{ $item->proveedor}} </p>
                          <p> <strong> Precio de venta unitario: </strong> {{ $item->precio_venta_unitario}} </p>
                          <p> <strong> Stock: </strong> {{ $item->stock}} </p>
                          <p> <strong> Stock mínimo: </strong> {{ $item->stock_minimo}} </p>
                          <p> <strong> Código de barras: </strong> {{ $item->codigo_barras}} </p>
                        </div>
                    </div>
                </div>
      </div>
    @endforeach
@endsection

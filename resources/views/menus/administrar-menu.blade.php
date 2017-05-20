@extends('layouts.agregar-editar-item')
@section('head')
  <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
  <script src="/js/logicaMenu.js"></script>
@endsection
@section('tipo', 'Menu')
@section('agregar-editar-form')


  {!! Form::open(['route' => ['menus.update', $menuAdministrar->fecha], 'method' => 'PUT']) !!}

    <div class="row margin-top-md">
      <div class="col-md-6 fixing-select">
            {!! Form::label('producto_id', 'Producto a comprar')!!}
            {!! Form::select('productoComprar', $productos, null, ["class" => "form-control", 'id' => 'productoComprar']); !!}
      </div>
      <div class="col-md-4 input-margin">
        <button class="btn btn-success" type="button" onclick="agregarProducto()"> Añadir al menú </a>
      </div>
    </div>


    <div class="panel panel-default ">
      <div class="panel-heading"><h4>Menú del día {{ $menuAdministrar->fecha }}</h4></div>
      <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
                  <table class="table" id="productosComprados">
                      <tr>
                        <th>Producto</th>
                        <th></th>
                      </tr>
                        @foreach ($menuAdministrar->productosDelMenu as $producto)
                          <tr class="table-gray" id="{{$producto->id}}">
                            <th>{{$producto->nombre}}</th>
                            <th><button class="btn-sm btn-danger" type="button" onclick="borrarDelCarrito({{$producto->id}})"> Remover </th>
                          <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                agregarAlCarrito({{$producto->id}});
                            }, false);
                          </script>
                          </tr> 
                        @endforeach
                  </table>
            </div>
          </div>
        </div>
    </div>

    <input type="hidden" value="null" name="carrito" id="carrito" />

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/menus"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}


@endsection
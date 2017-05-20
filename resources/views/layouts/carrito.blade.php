    @section('head')
      <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
      <script src="/js/logicaCarrito.js"></script>
    @endsection 

    <div class="row margin-top-md">
      <div class="col-md-6 fixing-select">
            {!! Form::label('producto_id', 'Producto a comprar')!!}
            {!! Form::select('productoComprar', $productos, null, ["class" => "form-control", 'id' => 'productoComprar']); !!}
      </div>
      <div class="col-md-2">
        <div class="input-margin">
            {!! Form::number('cantidadProducto', 1, ['class' => 'form-control', 'id' => 'cantidadComprar', 'min' => 1]) !!}
        </div>
      </div>
      <div class="col-md-4 input-margin">
        <button class="btn btn-success" type="button" onclick="agregarProducto()"> Actualizar producto </a>
      </div>
    </div>


    <div class="panel panel-default ">
      <div class="panel-heading"><h4>Productos comprados</h4></div>
      <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
                  <table class="table" id="productosComprados">
                      <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th></th>
                      </tr>
                      @if ($operacion == 'editar')
                        @foreach ($compra->detalles as $detalle)
                          <tr class="table-gray" id="{{$detalle->producto->id}}">
                            <th>{{$detalle->producto->nombre}}</th>
                            <th>{{$detalle->cantidad}}</th>
                            <th><button class="btn-sm btn-danger" type="button" onclick="borrarDelCarrito({{$detalle->producto->id}})"> Remover </th>
                          <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                agregarAlCarrito({{$detalle->producto->id}}, {{$detalle->cantidad}});
                            }, false);
                          </script>
                          </tr> 
                        @endforeach
                      @endif
                  </table>
            </div>
          </div>
        </div>
    </div>

    <input type="hidden" value="null" name="carrito" id="carrito" />
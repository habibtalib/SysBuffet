@extends('layouts.listar-items', ['noMostrar' => true])
@section('titulo', 'Pedidos')
@section('insertar-link','/pedidos/create')

@section('orden')
 <div class="btn-group margin-bot-sm text-center">
          <button type="button" class="text-center btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="/pedidos/pendientes/ordenar">Mostrar solo pendientes</a></li>
            <li><a href="/pedidos/usuario_id/ordenar">Usuario</a></li>
            <li><a href="/pedidos/fecha/ordenar">Fecha de pedido</a></li>
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
                          <span id="title">Pedido #{{$item->id}}, de {{$item->usuario->usuario}}</span>
                          <span class="pull-right"> | | </span>
                          <a href="#" onclick='eliminar("pedidos", "{{$item->id}}")'><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Nombre: </strong> {{ $item->usuario->nombre }} </p>
                          <p> <strong> Fecha del pedido: </strong> {{ $item->fecha}} </p>
                          <p> <strong> Fecha: </strong> {{ $item->fecha }} </p>
                          <p> <strong> Estado: 
                                              @if($item->estado->nombre  == 'pendiente')
                                                <span class="label label-info"> 
                                              @elseif($item->estado->nombre == 'entregado')
                                                <span class="label label-success"> 
                                              @elseif($item->estado->nombre == 'cancelado')
                                                <span class="label label-danger"> 
                                              @endif
                                                    {{$item->estado->nombre}} 
                                                </span> </strong></p>
                           <ul class="list-group">
                            @foreach ($item->productosPedidos as $detalle)
                              <li class="list-group-item"> 
                                <p> Nombre: {{ $detalle->nombre}} </p>
                                <p> Marca: {{ $detalle->marca}} </p>
                                <p> Cantidad: {{ $detalle->pivot->cantidad }} </p>
                            @endforeach
                          </ul>
                        </div>
                        @if($item->estado->nombre == 'pendiente')
                          <div class="text-center">
                            <span>
                              <h4><a class="btn btn-success" onClick="aceptar({{$item->id}})" data-toggle="modal" data-target="#aceptar" role="button">Aceptar pedido</a></span></h4>
                              <h4><button class="btn btn-danger" role="button" onClick="rechazar({{$item->id}})" data-toggle="modal" data-target="#rechazar">Rechazar pedido</button></h4>
                            </span>
                          </div>
                        @endif
                    </div>
                </div>
      </div>
    @endforeach

      <div class="modal fade" id="rechazar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">¿Esta seguro que desea rechazar el pedido?</h4>
          </div>
          <div class="modal-body">
            <div class="form-group gray-color">
              <label for="exampleInputEmail1">Razón del rechazo</label>
              <input type="text" class="form-control" id="motivo" placeholder="Escriba el motivo de rechazo del pedido">
              <input type="hidden" value="null" class="form-control" id="idRechazar" placeholder="Escriba el motivo de rechazo del pedido">
            </div>
            <div class="row input-margin">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-success" id="success-rechazar" role="alert"><span class="glyphicon glyphicon-warning-ok" aria-hidden="true"></span> <span class="bold"> Éxito! </span> El pedido fue rechazado exitosamente!</div>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger" onClick="efectuarRechazo()">Rechazar pedido</button>
          </div>
        </div>
      </div>
    </div>

     <div class="modal fade" id="aceptar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">¿Esta seguro que desea aceptar el pedido?</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-success" id="success-aceptar" role="alert"><span class="glyphicon glyphicon-warning-ok" aria-hidden="true"></span> <span class="bold"> Éxito! </span> El pedido ha sido aceptado!</div>
            	 </div>
          	</div>
          </div>
          <div class="modal-footer">
            <input type="hidden" value="null" class="form-control" id="idAceptar" placeholder="Escriba el motivo de rechazo del pedido">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onClick="efectuarPedido()">Aceptar pedido</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script-footer')
	<script src="/js/logicaConfirmarPedidos.js"></script>
@endsection


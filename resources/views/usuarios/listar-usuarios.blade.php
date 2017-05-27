@extends('layouts.listar-items')
@section('titulo', 'Usuarios')
@section('insertar-link','/usuarios/create')

@section('orden')
 <div class="btn-group margin-bot-sm text-center">
          <button type="button" class="text-center btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="/usuarios/pendientes/ordenar">Esperando habilitación</a></li>
            <li><a href="/usuarios/nombre/ordenar">Nombre</a></li>
            <li><a href="/usuarios/apellido/ordenar">Apellido</a></li>
            <li><a href="/usuarios/documento/ordenar">Documento</a></li>
            <li><a href="/usuarios/email/ordenar">Correo electrónico</a></li>
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
                          <span id="title">{{ $item->usuario }}</span>
                          <a href="/usuarios/{{$item->slug}}/edit"><span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a>
                          <span class="pull-right"> | | </span>
                          <a href="#" onclick='eliminar("usuarios", "{{$item->slug}}")'><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>
                        </h2>
                        </div>
                        <div class="panel-body">
                          <p> <strong> Nombre: </strong> <span id="content{{$item->id}}">{{ $item->nombre }}</span></p>
                          <p> <strong> Apellido: </strong> {{ $item->apellido }} </p>
                          <p> <strong> Documento: </strong> {{ $item->documento}} </p>
                          <p> <strong> Correo electrónico: </strong> {{ $item->email}} </p>
                          <p> <strong> Departamento: </strong> {{ $item->departamento}} </p>
                          <p> <strong> Ubicación: </strong> {{ $item->ubicacion->nombre}} </p>
                          @if($item->rol->nombre == 'usuario')
                          <p> <strong> Habilitado: </strong> @if($item->habilitado == 1) 
                                                                Habilitado 
                                                              @else 
                                                                No habilitado | 
                                                                <a class="btn-sm btn-success" href="/usuarios/{{$item->slug}}/habilitar" role="button"> Habilitar </a>
                                                                </span>
                                                              @endif
                                                  </p>
                          @endif
                          <p> <strong> Rol: </strong> {{ $item->rol->nombre}} </p>
                        </div>
                    </div>
                </div>
      </div>
    @endforeach
@endsection
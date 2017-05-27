@extends('layouts.main-frontend')
@section('main-content')

<div class="panel panel-success">
    <div class="panel-heading bold">
      <h3 class="panel-title bold">
        </span> Acerca de {{ $settings['nombre']}}   
      </h3>
    </div>
    <div class="panel-body">
      <div class="col-md-offset-1 col-md-10">
         <span ><h1 class="lobster primary-color">{{$settings['nombre']}}</h1></span>
         <div class="input-margin">
            <h3 class="lobster primary-color">Descripción</h3></span>
            <div>{{ $settings['descripcion']}}</div>
         </div>
         <div class="input-margin">
            <h3 class="lobster primary-color">Correo electrónico de contacto</h3></span>
            <div>{{ $settings['mail_contacto']}}</div>
         </div>
      </div>
    </div>
</div>

@endsection

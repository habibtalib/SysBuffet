@extends('layouts.mostrar-fechas')
@section('main-content')
@section('accion', 'administrar el menu de ese día')
@section('titulo', 'Administrar menú')

@section('formulario-fechas')

{!! Form::open(['url' => '/menus/editar']) !!}


  <div class="form-group input-margin">
      {!! Form::label('menu_dia', 'Fecha del menú') !!}
      {!! Form::text('menu_dia', null, ['class' => 'form-control', 'placeholder' => 'Click aquí para desplegar calendario', 'id' => 'datepicker']) !!}
   </div>

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/home"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

{!! Form::close() !!}

@endsection
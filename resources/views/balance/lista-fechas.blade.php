@extends('layouts.mostrar-fechas')
@section('main-content')
@section('accion', 'listar el balance')
@section('titulo', 'Realizar balance')

@section('formulario-fechas')

  {!! Form::open(['url' => '/balance/']) !!}


  <div class="form-group input-margin">
      {!! Form::label('fecha_inicio', 'Fecha de inicio') !!}
      {!! Form::text('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Click aquí para desplegar calendario', 'id' => 'datepicker']) !!}
   </div>

     <div class="form-group input-margin">
      {!! Form::label('fecha_fin', 'Fecha de fin') !!}
      {!! Form::text('fecha_fin', null, ['class' => 'form-control', 'placeholder' => 'Click aquí para desplegar calendario', 'id' => 'datepicker1']) !!}
   </div>

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/home"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}

@endsection

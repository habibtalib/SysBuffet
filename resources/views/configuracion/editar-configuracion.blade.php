@extends('layouts.agregar-editar-item')
@section('tipo', 'configuración')
@section('agregar-editar-form')


  {!! Form::open(['url' => 'configuracion/configurar']) !!}

        <div class="form-group input-margin">
            {!! Form::label('nombre', 'Nombre de la aplicación') !!}
            {!! Form::text('nombre', Setting::get('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre de la aplicación']) !!}
         </div>

        <div class="form-group input-margin">
            {!! Form::label('descripcion', 'Descripción de la aplicación') !!}
            {!! Form::text('descripcion', Setting::get('descripcion'), ['class' => 'form-control', 'placeholder' => 'Descripción de la aplicación']) !!}
         </div>

        <div class="form-group input-margin">
            {!! Form::label('mail_contacto', 'Mail de contacto') !!}
            {!! Form::text('mail_contacto', Setting::get('mail_contacto'), ['class' => 'form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
         </div>

         <div class="form-group input-margin">
            {!! Form::label('sitio_habilitado', 'Sitio habilitado o no') !!}
            {!! Form::select('sitio_habilitado', ['habilitado' => 'Habilitado', 'deshabilitado' => 'Deshabilitado'], Setting::get('sitio_habilitado'), ["class" => "form-control"]); !!}
         </div>
  
         <div class="form-group input-margin">
            {!! Form::label('mensaje_deshabilitacion', 'Mensaje de deshabilitación') !!}
            {!! Form::text('mensaje_deshabilitacion', Setting::get('mensaje_deshabilitacion'), ['class' => 'form-control', 'placeholder' => 'Mensaje']) !!}
         </div>

        <div class="form-group input-margin">
            {!! Form::label('items_paginados', 'Items por página') !!}
            {!! Form::number('items_paginados', Setting::get('items_paginados'), ['class' => 'form-control', 'min' => 1]) !!}
        </div>

        <div class="text-center input-margin">
            <a class="btn btn-warning" href="/home"> Regresar </a>
            {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
        </div>

  {!! Form::close() !!}
@endsection
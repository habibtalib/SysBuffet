@extends('layouts.agregar-editar-item')
@section('tipo', 'usuario')
@section('agregar-editar-form')

  @if ($operacion == 'editar')
      {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario->slug], 'method' => 'PUT']) !!}
  @else
      {!! Form::open(['url' => 'usuarios']) !!}
  @endif

  <div class="form-group input-margin">
      {!! Form::label('nombre', 'Nombre') !!}
      {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
   </div>

   <div class="form-group input-margin">
      {!! Form::label('apellido', 'Apellido') !!}
      {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
   </div>

  <div class="form-group input-margin">
      {!! Form::label('usuario', 'Usuario') !!}
      {!! Form::text('usuario', null, ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
  </div>

  @if($operacion=='insertar')
        <div class="form-group input-margin">
          {!! Form::label('password', 'Contraseña') !!}
          {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'password']) !!}
        </div>
  @endif

  <div class="form-group input-margin">
      {!! Form::label('documento', 'Documento') !!}
      {!! Form::text('documento', null, ['class' => 'form-control', 'placeholder' => 'Documento']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('email', 'Correo electrónico') !!}
      {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('telefono', 'Teléfono') !!}
      {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('departamento', 'Departamento') !!}
      {!! Form::text('departamento', null, ['class' => 'form-control', 'placeholder' => 'Departamento']) !!}
  </div>

  <div class="form-group">
    {!! Form::label('ubicacion_id', 'Ubicación')!!}
    @if($operacion=='insertar')
        {!! Form::select('ubicacion_id', $ubicaciones, null, ["class" => "form-control"]); !!}
    @else
        {!! Form::select('ubicacion_id', $ubicaciones, $usuario->categoria_id, ["class" => "form-control"]); !!}
    @endif
  </div>

    <div class="form-group">
    {!! Form::label('rol_id', 'Rol')!!}
    @if($operacion=='insertar')
        {!! Form::select('rol_id', $roles, null, ["class" => "form-control"]); !!}
    @else
        {!! Form::select('rol_id', $roles, $usuario->rol_id, ["class" => "form-control"]); !!}
    @endif
  </div>

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/usuarios"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}
@endsection
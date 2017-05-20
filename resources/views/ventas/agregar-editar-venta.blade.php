@extends('layouts.agregar-editar-item')
@section('tipo', 'ventas')
@section('agregar-editar-form')

  @if ($operacion == 'editar')
      {!! Form::model($detalleIngreso, ['route' => ['ventas.update', $detalleIngreso->id], 'method' => 'PUT']) !!}
  @else
      {!! Form::open(['url' => 'ventas']) !!}
  @endif

   <div class="form-group">
     {!! Form::label('producto_id', 'Producto vendido')!!}
     @if($operacion=='insertar')
         {!! Form::select('producto_id', $productos, null, ["class" => "form-control"]); !!}
     @else
         {!! Form::select('producto_id', $productos, $detalleIngreso->producto_id, ["class" => "form-control"]); !!}
     @endif
   </div>

   <div class="form-group input-margin">
       {!! Form::label('cantidad', 'Cantidad vendida') !!}
       {!! Form::number('cantidad', null, ['class' => 'form-control', 'step' => 'any', 'min' => 1, 'default' => 1]) !!}
    </div>

    <div class="form-group input-margin">
        {!! Form::label('descripcion', 'Descripcion') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Opcional' ]) !!}
     </div>

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/ventas"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}
@endsection

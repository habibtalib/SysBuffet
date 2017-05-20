@extends('layouts.agregar-editar-item')
@section('tipo', 'producto')
@section('agregar-editar-form')

  @if ($operacion == 'editar')
      {!! Form::model($producto, ['route' => ['productos.update', $producto->slug], 'method' => 'PUT']) !!}
  @else
      {!! Form::open(['url' => 'productos']) !!}
  @endif

  <div class="form-group input-margin">
      {!! Form::label('nombre', 'Nombre') !!}
      {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
   </div>

   <div class="form-group input-margin">
      {!! Form::label('marca', 'Marca') !!}
      {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Marca']) !!}
   </div>

  <div class="form-group input-margin">
      {!! Form::label('proveedor', 'Proveedor') !!}
      {!! Form::text('proveedor', null, ['class' => 'form-control', 'placeholder' => 'Proveedor']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('descripcion', 'Descripción') !!}
      {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('precio_venta_unitario', 'Precio de venta unitario') !!}
      {!! Form::number('precio_venta_unitario', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('stock', 'Stock') !!}
      {!! Form::number('stock', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('stock_minimo', 'Stock mínimo') !!}
      {!! Form::number('stock_minimo', null, ['class' => 'form-control']) !!}
  </div>

  <div class="form-group input-margin">
      {!! Form::label('codigo_barras', 'Codigo de barras') !!}
      {!! Form::number('codigo_barras', null, ['class' => 'form-control']) !!}
  </div>

<div class="form-group">
  {!! Form::label('categoria_id', 'Categoria')!!}
  @if($operacion=='insertar')
      {!! Form::select('categoria_id', $categorias, null, ["class" => "form-control"]); !!}
  @else
      {!! Form::select('categoria_id', $categorias, $producto->categoria_id, ["class" => "form-control"]); !!}
  @endif
</div>

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/productos"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}
@endsection

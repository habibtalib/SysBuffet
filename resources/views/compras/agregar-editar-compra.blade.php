@extends('layouts.agregar-editar-item')
@section('tipo', 'compra')
@section('agregar-editar-form')


@if ($operacion == 'editar')
      {!! Form::model($compra, ['route' => ['compras.update', $compra->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
@else
      {!! Form::open(['url' => 'compras', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
@endif

    <div class="form-group input-margin">
        {!! Form::label('cuit_proveedor', 'CUIT del proveedor') !!}
        {!! Form::text('cuit_proveedor', null, ['class' => 'form-control', 'placeholder' => 'CUIT del proveedor']) !!}
     </div>

     <div class="form-group input-margin">
        {!! Form::label('proveedor', 'Nombre del proveedor') !!}
        {!! Form::text('proveedor', null, ['class' => 'form-control', 'placeholder' => 'Nombre del proveedor']) !!}
     </div>

     <div class="form-group input-margin">
        {!! Form::label('factura', 'Imagen de la factura') !!}
        {{Form::file('factura', null, ['class' => 'form-control'])}}
     </div>


  <div class="row">
      <div class="col-md-offset-1 col-md-10 margin-top-md">
        <div class="h-divider"></div>
      </div>
  </div>
     
  @include('layouts.carrito')

  <div class="text-center input-margin">
      <a class="btn btn-warning" href="/compras"> Regresar </a>
      {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
  </div>

  {!! Form::close() !!}


@endsection
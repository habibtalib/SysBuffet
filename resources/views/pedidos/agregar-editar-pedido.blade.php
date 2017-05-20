@extends('layouts.agregar-editar-item')
@section('tipo', 'pedido')
@section('agregar-editar-form')


@if ($operacion == 'editar')
      {!! Form::model($pedido, ['route' => ['pedidos.update', $pedido->id], 'method' => 'PUT']) !!}
@else
      {!! Form::open(['url' => '/pedidos']) !!}
@endif
     
     @include('layouts.carrito')

    <div class="text-center input-margin">
          <a class="btn btn-warning" href="/home"> Regresar </a>
          {!! Form::button('Enviar datos', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
    </div>

  {!! Form::close() !!}


@endsection
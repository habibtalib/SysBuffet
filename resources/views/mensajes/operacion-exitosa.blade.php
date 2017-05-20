@extends('layouts.main-frontend')

@section('main-content')
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Operacion exitosa!</h3>
  </div>
  <div class="panel-body">
    <div class="text-center">
      <img src="/imgs/exito.png" class="little-banner">
    </div>
    <div class="input-margin text-center">
      <h3 class="primary-color">El @yield('item') ha sido @yield('operacion') con éxito!</h3>
    </div>
    <div class="input-margin text-center">
      <a class="btn btn-info" href="@yield('volver')">Volver</a>
    </div>
  </div>
</div>
@endsection

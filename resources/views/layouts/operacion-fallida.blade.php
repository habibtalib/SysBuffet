@extends('layouts.main-frontend')

@section('main-content')
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Operacion fallida!</h3>
  </div>
  <div class="panel-body">
    <div class="text-center">
      <img src="/imgs/fail.png" class="little-banner">
    </div>
    <div class="input-margin text-center">
      <h3 class="gray-color">@yield('mensaje')</h3>
    </div>
    <div class="input-margin text-center">
      <a class="btn btn-info" href="@yield('volver')">Volver</a>
    </div>
  </div>
</div>
@endsection
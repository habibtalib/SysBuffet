@extends('layouts.main-frontend')
@section('main-content')

<div class="panel panel-success">
    <div class="panel-heading bold">
      <h3 class="panel-title bold">
        @if ($operacion == 'insertar')
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>   Agregar @yield('tipo')
        @else
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>   Editar @yield('tipo')
        @endif
      </h3>
    </div>
    <div class="panel-body">
      <div class="col-md-offset-1 col-md-10">

        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('agregar-editar-form')
      </div>
    </div>
</div>

@endsection

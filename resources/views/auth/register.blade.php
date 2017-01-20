@extends('modal')

@section('title')
    Registrarse
@endsection
@section('subtitle')
    <div class="assist" assistID="0">
        ¿Tienes Cuenta? <b>Ingresa</b>
    </div>
@endsection

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}

    <div class="inner-addon left-addon form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <i class="glyphicon glyphicon-user"></i>
        <input id="name" placeholder="Nombre" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="inner-addon left-addon form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <i class="glyphicon glyphicon-envelope"></i>
        <input id="email" placeholder="Correo Electrónico" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="inner-addon left-addon form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <i class="glyphicon glyphicon-lock"></i>
        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>


        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="inner-addon left-addon form-group">
        <i class="glyphicon glyphicon-lock"></i>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
    </div>

    <div class="form-group actions">
        <button type="submit" class="btn btn-success">
            Registrarse
        </button>
    </div>
</form>
@endsection

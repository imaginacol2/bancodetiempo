@extends('modal')

@section('title')
    Ingresar
@endsection
@section('subtitle')
    <div id="callregister">
        ¿Nuevo? <b>Registrate</b>
    </div>
@endsection

@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="inner-addon left-addon form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-envelope"></i>
            <input id="email" placeholder="Correo Electrónico" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>


            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="inner-addon left-addon form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-lock"></i>
            <input placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <input type="hidden" value="on" name="remember" />

        <div class="form-group actions">
            <button type="submit" class="btn btn-success">
                Ingresar
            </button>
        </div>
    </form>
@endsection

@section('footer')
    <div class="recoverpass">
        Recordar contraseña
    </div>
@endsection
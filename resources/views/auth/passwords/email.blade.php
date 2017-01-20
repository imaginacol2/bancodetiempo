@extends('modal')

@section('title')
    Reiniciar Contraseña
@endsection
@section('subtitle')
    <div class="assist" assistID="0">
        Volver al <b>Ingreso</b>
    </div>
@endsection

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}
    <div class="inner-addon left-addon form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <i class="glyphicon glyphicon-envelope"></i>
        <input id="email" type="email" class="form-control" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group actions">
        <button type="submit" class="btn btn-success">
            Recordar
        </button>
    </div>
</form>
@endsection
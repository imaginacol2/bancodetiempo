@extends('modal')

@section('title')
    Crear una actividad
@endsection
@section('subtitle')
    <div id="callregister">
        fácil y rápido
    </div>
@endsection

@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/createactivity/') }}">
        {{ csrf_field() }}

        <div class="inner-addon left-addon form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-eye-open"></i>
            <input id="title" placeholder="Nombre" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>


            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="inner-addon left-addon form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-align-justify"></i>
            <textarea id="description" placeholder="Descripción" type="text" class="form-control" name="description" value="{{ old('description') }}" required></textarea>



            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>



        <div class="inner-addon left-addon form-group{{ $errors->has('place') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-map-marker"></i>
            <input id="place" placeholder="Lugar" type="text" class="form-control" name="place" value="{{ old('place') }}" required>


            @if ($errors->has('place'))
                <span class="help-block">
                    <strong>{{ $errors->first('place') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
            <div class='input-group date' id='datetimepicker1'>
                <input name="time" id="time" type='text' class="form-control" placeholder="Fecha y Hora" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>

            @if ($errors->has('time'))
                <span class="help-block">
                    <strong>{{ $errors->first('time') }}</strong>
                </span>
            @endif
        </div>

        <div class="scroll form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-time"></i>
            Duración
            <input name="duration" value="1" id="duration" data-slider-id='durationSlider' type="text" data-slider-min="1" data-slider-max="8" data-slider-step="1" data-slider-value="1"/>
            @if ($errors->has('duration'))
                <span class="help-block">
                    <strong>{{ $errors->first('duration') }}</strong>
                </span>
            @endif
        </div>

        <div class="scroll form-group{{ $errors->has('userlimit') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-user"></i>
            Limite de Personas (0: Ilimitado)
            <input name="userlimit" value="0" id="userlimit" data-slider-id='userlimitSlider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
            @if ($errors->has('duration'))
                <span class="help-block">
                    <strong>{{ $errors->first('userlimit') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
            <i class="glyphicon glyphicon-th"></i>
            Categoría
            <select name="category" id="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

            @if ($errors->has('time'))
                <span class="help-block">
                    <strong>{{ $errors->first('time') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group actions">
            <button type="submit" class="btn btn-success">
                Crear
            </button>
        </div>
    </form>

    <script>
        $('#duration').slider({
            formatter: function(value) {
                return 'Horas: ' + value;
            }
        });
        $('#userlimit').slider({
            formatter: function(value) {
                return 'Personas: ' + value;
            }
        });

        $('#datetimepicker1').datetimepicker();
    </script>

@endsection
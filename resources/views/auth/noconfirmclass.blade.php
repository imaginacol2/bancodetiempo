@extends('modal')

@section('title')
    Atención
@endsection
@section('subtitle')
    <div>
        Ha ocurrido algo
    </div>
@endsection

@section('content')
    <div class="noconfirmmessage">
        {{$message}}
    </div>
    <script>
        $('#myModal').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>
@endsection
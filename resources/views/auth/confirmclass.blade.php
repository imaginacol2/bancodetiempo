@extends('modal')

@section('title')
    Asistencia Confirmada
@endsection
@section('subtitle')
    <div>
        Te esperamos
    </div>
@endsection

@section('content')
<script>
    $('#myModal').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>
@endsection
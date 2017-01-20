@extends('modal')

@section('title')
    ¡Ya ingresó!
@endsection
@section('subtitle')
    <div>
        Ya se encuentra logeado
    </div>
@endsection

@section('content')
    Cierre la ventana para continuar
<script>
    $('#myModal').on('hidden.bs.modal', function () {
        location.reload();
    })
</script>
@endsection
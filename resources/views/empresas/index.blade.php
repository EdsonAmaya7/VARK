@extends('layouts.base_html')

@section('title')
    Empresa
@endsection

@section('content')
@include('layouts.navigation')
<div class="container shadow-lg p-2 mb-5 mt-1 bg-body rounded ">
    <h2 style="text-align:center" class="p-3 fondo">Empresas</h2>

    <table id="tabla" class="table table-striped mt-5 mb-3" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Empresa</th>
                <th class="text-center">Fecha de creacion</th>
                <th class="text-center">Acciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $empresa)
            <tr>
                <td class="text-center">{{ $empresa->nombre_empresa }}</td>
                <td class="text-center">{{ $empresa->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route("empresas.edit", $empresa->id) }}" class="text-center"><i class="fas fa-edit"></i></a>
                    <a onclick="eliminarEmpresa({{$empresa->id}})"><span><i class="fas fa-trash" style="color:#00225F"></i></a>
                        <a href="{{ route("empresas.create") }}" class="text-center"><i class="fas fa-plus-circle"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



@push('scripts')
<script>
    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<script>
    function mensajeSwal(message, icon, title) {
    Swal.fire({
        timer: 1500,
        icon: icon,
        title: title,
        text: message,
    });
}

   async function eliminarEmpresa(id){
    event.preventDefault()
    let url = route('empresas.destroy',id)

    let init = {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": window.CSRF_TOKEN,
            "Content-Type": "application/json",
            Accept: "application/json",
        }
    }

    let req = await fetch(url,init)
    if(req.ok){
        mensajeSwal("Empresa Eliminado","success","success")
        location.reload()
        return;
    }

    // mensajeSwal("Algo Fallo ", "error", "Error")
}
</script>

@endpush

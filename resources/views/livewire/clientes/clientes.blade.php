<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2"><b> {{ $componentName }} | {{ $pageTitle}} </b></h5>
            <div class="dropdown">
                <a href="javascript:void(0)" class="btn btn-primary btn-rounded mb-2" data-bs-toggle="modal" data-bs-target="#myModal"> <i class="fa-solid fa-plus"></i> Agregar</a>
            </div>
        </div>
        <hr class="my-2">
        @include('common.searchbox')
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover table-sm">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">Nombre del Cliente</th>
                <th class="text-center">DUI / NIT</th>
                <th class="text-center">Direccion</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Registro</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ( $clientes as $cliente )
                <tr>
                    <td class="text-center"><b>{{ $cliente->id }}</b></td>
                    <td>{{ $cliente->nombreCliente }}</td>
                    <td>
                        @if ($cliente->homologado == 'SI')
                        {{ $cliente->dui }}
                        @else
                        {{ $cliente->nit }}
                        @endif
                    </td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->registro }}</td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="javascript:void(0);" wire:click="Edit('{{$cliente->id}}')"><i class="bx bx-edit-alt"></i>Editar</a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="Confirm('{{$cliente->id}}')"><i class="bx bx-trash"></i>Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    {{$clientes->links()}}
    @include('livewire.clientes.form')
</div>

@include('common.notis')

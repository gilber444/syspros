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
                <th class="text-center"></th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Email</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ( $data as $r )
                <tr>
                    <td>
                        @if ($r->img != null )
                        <img src="{{ asset('storage/usuarios/' . $r->img)}}" alt="{{$r->img}}" class="rounded-circle me-3 w-px-50">
                        @endif
                    </td>
                    <td class="text-center"><b>{{ $r->name}}</b></td>
                    <td class="text-center">{{ $r->phone }}</td>
                    <td class="text-center">{{ $r->email }}</td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="javascript:void(0);" wire:click="Edit('{{$r->id}}')"><i class="bx bx-edit-alt"></i>Editar</a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="Confirm('{{$r->id}}')"><i class="bx bx-trash"></i>Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    {{$data->links()}}
    @include('livewire.usuarios.form')
</div>

@include('common.notis')

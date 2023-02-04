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
                <th class="text-center">Codigo Barra</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Unidad de Medida</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ( $productos as $producto )
                <tr>
                    <td><img src="{{ asset('storage/productos/' . $producto->img)}}" alt="{{$producto->img}}" class="rounded-circle me-3 w-px-50"></td>
                    <td class="text-center"><b>{{ $producto->barcode }}</b></td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->medida }}</td>
                    <td class="text-center">
                        @if($producto->stock < $producto->alerts)
                            <span class="badge bg-label-danger me-1"><h5>{{ $producto->stock }}</h5></span>
                        @elseif ($producto->stock >= 10 and $producto->stock <= 20 )
                            <span class="badge bg-label-warning me-1"><h5>{{ $producto->stock }}</h5></span>
                        @else
                            <span class="badge bg-label-success me-1"><h5>{{ $producto->stock }}</h5></span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="javascript:void(0);" wire:click="Edit('{{$producto->id}}')"><i class="bx bx-edit-alt"></i>Editar</a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="Confirm('{{$producto->id}}')"><i class="bx bx-trash"></i>Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    {{$productos->links()}}
    @include('livewire.productos.form')
</div>

@include('common.notis')

<div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModal">{{$componentName}} | {{ $selected_id > 0 ? 'Editar' : 'Nuevo' }}</h5>
                <h6 class="text-center text-warning" wire:loading> POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="permissionName"><i class='bx bx-edit'></i></span>
                    <input type="text" wire:model.lazy='permissionName' class="form-control" placeholder="ej: Categoria_index">
                </div>
                @error('permissionName') <span class="text-danger er">{{ $message}}</span>@enderror
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent='resetUI()' class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                @if ($selected_id < 1)
                <button type="button" wire:click.prevent="CreatePermission()" class="btn btn-primary"><i class='bx bxs-save' ></i> Guardar Datos</button>
                @else
                <button type="button" wire:click.prevent="UpdatePermission()" class="btn btn-primary"><i class='bx bx-revision'></i> Actualizar Datos</button>
                @endif
            </div>
        </div>
    </div>
</div>

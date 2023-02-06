@include('common.modalHead')
<div class="input-group input-group-merge">
    <span class="input-group-text" id="name"><i class='bx bx-edit'></i></span>
    <input type="text" wire:model.lazy='name' class="form-control" placeholder="Nombre del Rol">
    <br>

</div>
@error('name') <span class="text-danger er">{{ $message}}</span>@enderror

</div>
<div class="modal-footer">
    <button type="button" wire:click.prevent='resetUI()' class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
    @if ($selected_id < 1)
    <button type="button" wire:click.prevent="CreateRole()" class="btn btn-primary"><i class='bx bxs-save' ></i> Guardar Datos</button>
    @else
    <button type="button" wire:click.prevent="UpdateRole()" class="btn btn-primary"><i class='bx bx-revision'></i> Actualizar Datos</button>
    @endif
</div>
</div>
</div>
</div>


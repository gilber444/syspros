</div>
<div class="modal-footer">
    <button type="button" wire:click.prevent='resetUI()' class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
    @if ($selected_id < 1)
    <button type="button" wire:click.prevent="Store()" class="btn btn-primary"><i class='bx bxs-save' ></i> Guardar Datos</button>
    @else
    <button type="button" wire:click.prevent="Update()" class="btn btn-primary"><i class='bx bx-revision'></i> Actualizar Datos</button>
    @endif
</div>
</div>
</div>
</div>


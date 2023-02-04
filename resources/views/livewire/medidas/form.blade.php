@include('common.modalHead')
<div class="input-group input-group-merge">
    <span class="input-group-text" id="medida"><i class='bx bx-edit'></i></span>
    <input type="text" wire:model.lazy='medida' class="form-control" placeholder="Nombre de la Unidad de Medida">
    <br>

</div>
@error('medida') <span class="text-danger er">{{ $message}}</span>@enderror
@include('common.modalFooter')

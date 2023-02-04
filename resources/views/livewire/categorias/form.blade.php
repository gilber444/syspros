@include('common.modalHead')
<div class="input-group input-group-merge">
    <span class="input-group-text" id="categoria"><i class='bx bx-edit'></i></span>
    <input type="text" wire:model.lazy='categoria' class="form-control" placeholder="Nombre de la Categoria">
    <br>

</div>
@error('categoria') <span class="text-danger er">{{ $message}}</span>@enderror
@include('common.modalFooter')

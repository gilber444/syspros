<div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModal">{{$componentName}} | {{ $selected_id > 0 ? 'Editar' : 'Nuevo' }}</h5>
                <h6 class="text-center text-warning" wire:loading> POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nombre del Cliente</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="nombreCliente"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='nombreCliente' class="form-control" placeholder="Nombre del Cliente">
                        </div>
                        @error('nombreCliente') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">DUI</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="dui"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='dui' class="form-control" placeholder="00000000-0">
                        </div>
                        @error('dui') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Homologado</label>
                        <div class="input-group">
                            <select wire:model.lazy='homologado' class="form-select" id="inputGroupSelect01">
                              <option value="SI" selected="SI">SI</option>
                              <option value="NO">NO</option>
                            </select>
                          </div>
                        @error('homologado') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="form-label">NIT</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="nit"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='nit' class="form-control" placeholder="0000-000000-000-0">
                        </div>
                        @error('nit') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label class="form-label">Registro</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="registro"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='registro' class="form-control">
                        </div>
                        @error('registro') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">Giro</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="giro"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='giro' class="form-control">
                        </div>
                        @error('giro') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Telefono</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="telefono"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='telefono' class="form-control" placeholder="00000000">
                        </div>
                        @error('telefono') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Direccion</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="direccion"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='direccion' class="form-control">
                        </div>
                        @error('direccion') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>

@include('common.modalFooter')


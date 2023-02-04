<div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModal">{{$componentName}} | {{ $selected_id > 0 ? 'Editar' : 'Nuevo' }}</h5>
                <h6 class="text-center text-warning" wire:loading> POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="form-label">Codigo de Barras</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="barcode"><i class="fa-solid fa-barcode"></i></span>
                            <input type="text" wire:model.lazy='barcode' class="form-control" placeholder="0000000000">
                        </div>
                        @error('barcode') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Nombre del Producto</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="producto"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='producto' class="form-control" placeholder="Nombre del Producto">
                        </div>
                        @error('producto') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Exento</label>
                        <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Exento</label>
                            <select wire:model.lazy='exento' class="form-select" id="inputGroupSelect01">
                              <option value="NO" selected="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
                          </div>
                        @error('exento') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Nombre de la Marca</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="marca"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='marca' class="form-control" placeholder="Nombre de la marca">
                        </div>
                        @error('producto') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Costo</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="costo"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='costo' class="form-control" placeholder="0.00">
                        </div>
                        @error('costo') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Stock</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="stock"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='stock' class="form-control" placeholder="00">
                        </div>
                        @error('stock') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Alarma</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="alerts"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='alerts' class="form-control" placeholder="00">
                        </div>
                        @error('alerts') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select wire:model='categoriaId' class="select2 form-select form-select-lg" data-allow-clear="true">
                          <option value="Elegir">Elegir Categoria</option>
                          @foreach ($categorias as $categoria )
                          <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('categoriaId') <span class="text-danger er">{{ $message}}</span>@enderror
                    <div class="col-2">
                        <label class="form-label">Precio Venta 1</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="pv1"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='pv1' class="form-control" placeholder="0.00">
                        </div>
                        @error('pv1') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Cant1dad 1</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="cant1"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='cant1' class="form-control" placeholder="00">
                        </div>
                        @error('cant1') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Precio Venta 2</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="pv2"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='pv2' class="form-control" placeholder="0.00">
                        </div>
                        @error('pv2') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Cantidad 2</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="cant2"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='cant2' class="form-control" placeholder="00">
                        </div>
                        @error('cant2') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="medida" class="form-label">Unidad Medida</label>
                        <select wire:model='medidaId' class="select2 form-select form-select-lg" data-allow-clear="true">
                          <option value="Elegir">Elegir Uniad Medida</option>
                          @foreach ($medidas as $medida )
                          <option value="{{$medida->id}}">{{$medida->medida}}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('medidaId') <span class="text-danger er">{{ $message}}</span>@enderror
                    <div class="col-2">
                        <label class="form-label">Precio Venta 3</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="pv3"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='pv3' class="form-control" placeholder="0.00">
                        </div>
                        @error('pv3') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Cant1dad 3</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="cant3"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='cant3' class="form-control" placeholder="00">
                        </div>
                        @error('cant3') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Precio Venta 4</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="pv4"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='pv4' class="form-control" placeholder="0.00">
                        </div>
                        @error('pv4') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                    <div class="col-2">
                        <label class="form-label">Cantidad 4</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="cant4"><i class='bx bx-edit'></i></span>
                            <input type="text" wire:model.lazy='cant4' class="form-control" placeholder="00">
                        </div>
                        @error('cant4') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="formFile" class="form-label">Imagen del Producto</label>
                        <input class="form-control" type="file" wire:model="image" accept="image/x-png, image/x-gif, image/x-jpeg">
                    </div>
                    @error('image') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
@include('common.modalFooter')

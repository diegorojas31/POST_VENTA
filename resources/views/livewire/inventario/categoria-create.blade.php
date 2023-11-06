<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="modal-header">
        <h4 class="modal-title">Crear nueva categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <!-- Contenido de la primera columna -->
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Imagen (Opcional)
                        </div>
                        <div class="card-body text-center">
                            @if ($imagePath)
                                <img src="{{ $imagePath }}" alt="Imagen del producto" class="img-thumbnail"
                                    style="max-width: 100px; max-height: 50px; display: inline-block;">
                            @else
                                <img id="picture" src="{{ asset('images/no-image.png') }}" alt="Imagen del producto"
                                    class="img-thumbnail"
                                    style="max-width: 100px; max-height: 50px; display: inline-block;">
                            @endif

                            <p>Tamaño máximo 2MB, archivos: jpg y png.</p>
                        </div>
                        <div class="card-footer text-center">
                            <div class="form-group text-center">
                                <div class="d-flex justify-content-center">
                                    <label class="input-group-btn mr-2">
                                        <span class="btn btn-sm btn-primary">
                                            <i class="fas fa-image"></i> Subir Imagen
                                        </span>
                                        <input type="file" wire:model="file" class="form-control-file"
                                            accept="image/*" style="display: none;">
                                    </label>
                                </div>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control"
                            placeholder="Ingrese el nombre de la categoria">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción (opcional)</label>
                        <textarea wire:model="descripcion" class="form-control" placeholder="Ingrese una descripción" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button wire:click="save" class="btn btn-success">Crear Categoria</button>
    </div>
</div>

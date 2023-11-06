<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    {{-- Do your work, then step back. --}}
    <div class="modal-header">
        <h4 class="modal-title">Crear nuevo Almacen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        @if (session('success'))
            <div class="alert alert-success">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card-body">
            <div class="container">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input wire:model="nombre" type="text" class="form-control"
                        placeholder="Ingrese el nombre de la Unidad de Medida">
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea wire:model="descripcion" class="form-control" rows="3" placeholder="Ingrese una descripción"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button wire:click="save" class="btn btn-success">Crear Almacen</button>
    </div>
</div>

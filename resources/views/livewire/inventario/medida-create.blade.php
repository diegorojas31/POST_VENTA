<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="modal-header">
        <h4 class="modal-title">Crear nueva unidad de medida</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
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
                    <textarea wire:model="descripcion" class="form-control" placeholder="Ingrese una descripción" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="abreviatura">Abreviatura</label>
                    <input wire:model="abreviatura" type="text" class="form-control"
                        placeholder="Ingrese la abreviatura">
                    @error('abreviatura')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button wire:click="save" class="btn btn-success">Crear Unidad</button>
    </div>
</div>

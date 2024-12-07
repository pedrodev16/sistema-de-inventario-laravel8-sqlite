<div>
    <div class="mt-5">
        <div class="card">

            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de Proveedor</label>
                        <input type="text" class="form-control" id="nombre" wire:model="nombre">
                        @error('nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="contacto" wire:model="contacto">
                        @error('contacto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-primary">{{ $proveedorId ? 'Actualizar Proveedor' : 'Registrar Proveedor' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

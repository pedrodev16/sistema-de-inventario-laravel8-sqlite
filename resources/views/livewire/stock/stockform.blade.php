<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="updateStock">
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" wire:model="cantidad">
                    @error('cantidad')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" wire:model="ubicacion">
                    @error('ubicacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if ($stockId)
                    <button type="submit" class="btn btn-primary">Actualizar Stock</button>
                @endif

            </form>
        </div>
    </div>
</div>

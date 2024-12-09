<div>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="nombre_empresa" wire:model="nombre_empresa">
                        @error('nombre_empresa')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" id="fecha_registro" wire:model="fecha_registro">
                        @error('fecha_registro')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio_dolar" class="form-label">Precio del Dólar</label>
                        <input type="number" step="0.01" class="form-control" id="precio_dolar"
                            wire:model="precio_dolar">
                        @error('precio_dolar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="porcentaje_iva" class="form-label">Porcentaje IVA</label>
                        <input type="number" step="0.01" class="form-control" id="porcentaje_iva"
                            wire:model="porcentaje_iva">
                        @error('porcentaje_iva')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="porcentaje_mercadolibre" class="form-label">Porcentaje MercadoLibre</label>
                        <input type="number" step="0.01" class="form-control" id="porcentaje_mercadolibre"
                            wire:model="porcentaje_mercadolibre">
                        @error('porcentaje_mercadolibre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="porcentaje_ganacia_tienda" class="form-label">Porcentaje Ganancia Tienda</label>
                        <input type="number" step="0.01" class="form-control" id="porcentaje_ganacia_tienda"
                            wire:model="porcentaje_ganacia_tienda">
                        @error('porcentaje_ganacia_tienda')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($empresaId)
                        <button type="submit"
                            class="btn btn-primary">{{ $empresaId ? 'Actualizar Perfil' : 'Registrar Perfil' }}</button>
                    @endif
                    <button type="submit"
                        class="btn btn-primary">{{ $empresaId ? 'Actualizar Perfil' : 'Registrar Perfil' }}</button>

                </form>
            </div>
        </div>
    </div>
</div>

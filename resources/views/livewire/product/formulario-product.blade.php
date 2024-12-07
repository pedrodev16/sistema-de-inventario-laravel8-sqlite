<div>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Registro de Producto</h4>

            <form wire:submit.prevent="save">
                <!-- Mostrar loader durante el envío -->
                <div wire:loading>
                    <div>procesando...</div>
                </div>

                <!-- Contenido del formulario -->
                <div wire:loading.remove>
                </div>
                <div class="mb-3 mt-5">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" wire:model="nombre">
                    @error('nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" wire:model="descripcion">
                    @error('descripcion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    @if ($imagen)
                        <label>Imagen Actual</label><br>
                        <img src="{{ Storage::url($imagen) }}" alt="Imagen del Producto"
                            style="width: 100px; height: 100px;">
                        <br>
                    @endif
                    <label for="nuevaImagen" class="form-label">Cargar Nueva Imagen</label>
                    <input type="file" class="form-control" id="nuevaImagen" wire:model="nuevaImagen">
                    @error('nuevaImagen')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="costo" class="form-label">Costo</label>
                    <input type="number" class="form-control" id="costo" wire:model="costo">
                    @error('costo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="proveedor" class="form-label">Proveedor</label>
                    <select class="form-control" wire:model="proveedor">
                        <option value="">Seleccione un proveedor</option>
                        @foreach ($proveedores as $lista)
                            <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                        @endforeach
                    </select>
                    @error('proveedor')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-control" wire:model="categoria">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $lista)
                            <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <select class="form-control" wire:model="marca">
                        <option value="">Seleccione una marca</option>
                        @foreach ($marcas as $lista)
                            <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                        @endforeach
                    </select>
                    @error('marca')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" wire:model="codigo">
                    @error('codigo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-primary">{{ $productoId ? 'Actualizar Producto' : 'Registrar Producto' }}</button>
            </form>

        </div>
    </div>

</div>

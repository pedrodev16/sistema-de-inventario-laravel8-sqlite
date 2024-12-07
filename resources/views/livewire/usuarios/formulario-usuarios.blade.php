<div>
    <div class=" mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Tabla de Usuarios</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="name" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" wire:model="password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            wire:model="password_confirmation">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipo_admin" class="form-label">Nivel Administrativo</label>
                        <select class="form-control" id="tipo_admin" wire:model="tipo_admin">
                            <option value="">Seleccione un nivel</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                            @endforeach
                        </select>
                        @error('tipo_admin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-primary">{{ $userId ? 'Actualizar Usuario' : 'Registrar Usuario' }}</button>
                </form>
            </div>
        </div>
    </div>

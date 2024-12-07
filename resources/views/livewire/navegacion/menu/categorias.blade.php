<div>
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Categorias</h4>




            <div class="btn-group dropleft">
                <button type="button" class="btn btn-success">CATEGORIAS</button>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" x-placement="left-start"
                    style="position: absolute; transform: translate3d(-123px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    @foreach ($categorias as $lista)
                        <a class="dropdown-item {{ $categoriaSeleccionadaId === $lista->id ? 'active' : '' }}"
                            href="#" wire:click="seleccionarCategoria({{ $lista->id }})">
                            {{ $lista->nombre }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>





</div>

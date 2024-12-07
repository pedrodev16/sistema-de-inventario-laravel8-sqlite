<div>
    <div class="card">
        <div class="card-body">




            <div class="btn-group dropleft">
                <button type="button" class="btn btn-success"> Marcas</button>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" x-placement="left-start"
                    style="position: absolute; transform: translate3d(-123px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    @foreach ($marcas as $lista)
                        <a class="dropdown-item {{ $marcaSeleccionadaId === $lista->id ? 'active' : '' }}"
                            href="#" wire:click="seleccionarmarca({{ $lista->id }})">
                            {{ $lista->nombre }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>





</div>

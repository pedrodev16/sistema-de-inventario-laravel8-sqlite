<div>
    <!-- Botón flotante -->
    <button type="button" class="btn btn-success btn-lg rounded-circle"
        style="position: fixed; bottom: 20px; right: 20px;" data-toggle="modal" data-target="#currencyModal">
        <span style="font-size: 2em;">💱</span>
    </button>

    <!-- Ventana modal -->
    <div wire:ignore.self class="modal fade" id="currencyModal" tabindex="-1" role="dialog"
        aria-labelledby="currencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="background-image: url({{ asset('imagenes/convert.png') }}) ;     background-repeat: round;">
                <div class="modal-header" style="background: #0c0c0ccf;color: #fff;">
                    <h5 class="modal-title" id="currencyModalLabel">
                        Convertidor de Moneda Tasa de cambio:
                        {{ $exchangeRate }} Bs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: #000000ba;color: #fff;">
                    <div class="form-group">
                        <label for="usd">USD:</label>
                        <input placeholder="USD" type="number" id="usd" class="form-control" wire:model="usd">

                        <button class="btn btn-primary mt-2" wire:click="convertToBolivares">Convertir a
                            Bolívares</button>
                        <h1> {{ $result_bs }} bs</h1>

                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="bolivares">Bolívares:</label>
                        <input placeholder="BS" type="number" id="bolivares" class="form-control"
                            wire:model="bolivares">
                        <button class="btn btn-primary mt-2" wire:click="convertToUsd">Convertir a USD</button>
                        <h1>{{ $result_usd }} $</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            if ($('#currencyModal').hasClass('show')) {
                $('body').addClass('modal-open');
            }
        });
    });
</script>

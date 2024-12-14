<li class="dropdown">
    @if ($cant_stock > 0)
        <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
            <span>{{ $cant_stock }}</span>
        </i>
        <div class="dropdown-menu bell-notify-box notify-box">
            <span class="notify-title">Tiene {{ $cant_stock }} notificaciónes de bajo stock <a
                    href="{{ route('stock.index') }}">view
                    all</a></span>
            <div class="nofity-list">
                @foreach ($stocks as $stock)
                    <a href="#" class="notify-item">
                        <div class="notify-thumb">

                            <img src="{{ asset(str_replace('public', 'storage', $stock->productos->imagen)) }}"
                                alt="image">

                        </div>
                        <div class="notify-text">

                            @if ($stock->cantidad > 0)
                                <div class="alert alert-warning">
                                    <p>El producto <strong>{{ $stock->productos->nombre }}</strong> tiene una cantidad
                                        baja:
                                        <strong>{{ $stock->cantidad }}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <p>El producto <strong>{{ $stock->productos->nombre }}</strong>
                                        esta agotado
                                        <strong>agotado</strong>
                                    </p>
                                </div>
                            @endif


                        </div>
                    </a>
                @endforeach




            </div>
        </div>
    @endif
</li>

<li class="dropdown">

    <i class="ti-shopping-cart dropdown-toggle" data-toggle="dropdown">
        @if ($cant_not > 0)
            <span> {{ $cant_not }}</span>
        @endif
    </i>
    @if ($cant_not > 0)
        <div class="dropdown-menu notify-box nt-enveloper-box">
            <span class="notify-title"> Usted tiene {{ $cant_not }} productos añadidos<a
                    href="{{ route('carrito.index') }}">ver
                    todos</a></span>
            <div class="nofity-list">
                @foreach ($carrito as $index => $item)
                    <a href="#" class="notify-item">
                        <div class="notify-thumb">
                            <img src="{{ asset(str_replace('public', 'storage', $item['img'])) }}" alt="image">
                        </div>
                        <div class="notify-text">
                            <p>{{ $item['nombre'] }}</p>
                            <span class="msg">Hey I am waiting for you...</span>
                            <span>3:15 PM</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</li>

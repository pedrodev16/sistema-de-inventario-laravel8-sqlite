   <li class="dropdown">
       @if ($cant_not > 0)
           <i class="ti-shopping-cart dropdown-toggle" data-toggle="dropdown">

               <span> {{ $cant_not }}</span>

           </i>

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
                               <span class="msg">{{ $item['precio'] }}$ x {{ $item['cantidad'] }} =
                                   {{ $item['subtotal'] }}
                                   <button style="padding: 3px" class="btn btn-danger btn-sm"
                                       wire:click="eliminarProductoDelCarrito({{ $index }})"><i
                                           class="ti-close"></i></button></span>
                               {{-- <span>3:15 PM</span> --}}

                           </div>
                       </a>
                   @endforeach
               </div>
           </div>
       @endif
   </li>

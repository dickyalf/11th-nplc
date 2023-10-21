<div>
    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown"><i
                class="linearicons-cart"></i><span class="cart_count">{{ count($carts) }}</span></a>
        <div class="cart_box dropdown-menu dropdown-menu-right">
            <ul class="cart_list">
                @foreach ($carts as $cart)
                    <li>
                        <a href="javascript::void(0)" class="item_remove" wire:click='removeCart({{$cart->id}})'><i class="ion-close"></i></a>
                        <a href="#"><img src="{{ asset('storage/' . $cart->product->image) }}"
                                alt="cart_thumb1">{{ $cart->product->name }}</a>
                        <span class="cart_quantity"> {{ $cart->quantity}} x <span class="cart_amount">@rupiah($cart->product->price)</span> </span>
                    </li>
                @endforeach
            </ul>
            <div class="cart_footer">
                <p class="cart_total"><strong>Subtotal:</strong> @rupiah($totalCart)</p>
                <p class="cart_buttons"><a href="{{route('carts')}}" class="btn btn-fill-line view-cart">View
                        Cart</a><a href="{{route('checkout')}}" class="btn btn-fill-out checkout">Checkout</a></p>
            </div>
        </div>
    </li>
</div>

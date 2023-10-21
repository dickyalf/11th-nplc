<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive shop_cart_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="product-thumbnail"><a href="#"><img
                                            src="{{ asset('storage/' . $cart->product->image) }}"
                                            alt="{{ $cart->product->name }}"></a></td>
                                <td class="product-name" data-title="Product"><a
                                        href="#">{{ $cart->product->name }}</a>
                                </td>
                                <td class="product-price" data-title="Price">@rupiah($cart->product->price)</td>
                                <td class="product-quantity" data-title="Quantity">
                                    <div class="quantity">
                                        <input type="button" value="-" class="minus"
                                            wire:click="min({{ $loop->index }})">
                                        <input type="text" name="quantity" value="{{ $cart->quantity }}"
                                            title="Qty" class="qty" size="4"
                                            wire:model='carts.{{ $loop->index }}.quantity'
                                            wire:change="updateCartQuantity({{ $loop->index }})" disabled>
                                        <input type="button" value="+" class="plus"
                                            wire:click="plus({{ $loop->index }})">
                                    </div>
                                </td>
                                <td class="product-subtotal" data-title="Total">@rupiah($cart->product->price * $cart->quantity)</td>
                                <td class="product-remove" data-title="Remove"><a href="#" wire:click='removeCart({{$cart->id}})'><i
                                            class="ti-close"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="medium_divider"></div>
            <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            <div class="medium_divider"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="heading_s1 mb-3">
                <h6>Calculate Shipping</h6>
            </div>
            <form class="field_form shipping_calculator">
                <div class="form-row">
                    <div class="form-group col-lg-12 mb-3">
                        <div class="custom_select">
                            <select class="form-control" wire:model='province' wire:change="handleProvinceChange">
                                <option value="-1" selected>Choose a option...</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov['province_id'] }}">{{ $prov['province'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @if ($province != -1)
                    <div class="form-row">
                        <div class="form-group col-lg-12 mb-3">
                            <div class="custom_select">
                                <select class="form-control" wire:model='city'>
                                    <option value="-1" selected>Choose a option...</option>
                                    @foreach ($citys as $cit)
                                        <option value="{{ $cit['city_id'] }}">{{ $cit['city_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-row">
                    <div class="form-group col-lg-12 mb-3">
                        <span class="btn btn-fill-line" wire:click="calculate">Calculate</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="border p-3 p-md-4">
                <div class="heading_s1 mb-3">
                    <h6>Cart Totals</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="cart_total_label">Cart Subtotal</td>
                                <td class="cart_total_amount">@rupiah($totalCart)</td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">Shipping (JNE) {{ $delivery_fee != null ? $delivery_fee['etd']." Day" : "" }}</td>
                                <td class="cart_total_amount">@rupiah($delivery_fee != null ? $delivery_fee['value'] : 0)</td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">Total</td>
                                <td class="cart_total_amount"><strong>@rupiah($totalCart + ($delivery_fee != null ? $delivery_fee['value'] : 0))</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{route('checkout')}}" class="btn btn-fill-out">Proceed To CheckOut</a>
            </div>
        </div>
    </div>
</div>

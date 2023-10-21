<div class="row">
    <div class="col-md-6">
        <div class="heading_s1">
            <h4>Billing Details</h4>
        </div>
        <form>
            @if (!Auth::check())
                <div class="form-group mb-3">
                    <input type="text" required class="form-control @error('fullname') is-invalid @enderror"
                        placeholder="Fullname *" wire:model="fullname">
                    @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-group mb-3">
                <div class="custom_select">
                    <select class="form-control @error('province') is-invalid @enderror" wire:model='province'
                        wire:change="handleProvinceChange">
                        <option value="-1" selected>Choose a option...</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov['province_id'] }}">{{ $prov['province'] }}</option>
                        @endforeach
                    </select>
                    @error('province')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            @if ($province != -1)
                <div class="form-group mb-3">
                    <div class="custom_select">
                        <select class="form-control @error('city') is-invalid @enderror" wire:model='city'>
                            <option value="-1" selected>Choose a option...</option>
                            @foreach ($citys as $cit)
                                <option value="{{ $cit['city_id'] }}">{{ $cit['city_name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @endif
            @if ($province != -1 && $city != -1)
                <div class="form-group mb-3">
                    <div class="custom_select">
                        <select class="form-control @error('delivery_courier') is-invalid @enderror"
                            wire:model='delivery_courier' wire:change="handleCourierChange">
                            <option selected>Choose a option...</option>
                            <option value="jne">JNE
                            </option>
                            <option value="tiki">TIKI
                            </option>
                            <option value="pos">POS Indonesia
                            </option>
                        </select>
                        @error('delivery_courier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @endif
            <div class="form-group mb-3">
                <input type="text" class="form-control  @error('address') is-invalid @enderror"
                    name="billing_address" required="" placeholder="Address *" wire:model="address">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input class="form-control @error('zipcode') is-invalid @enderror" required type="text"
                    name="zipcode" placeholder="Postcode / ZIP *" wire:model='zipcode'>
                @error('zipcode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input class="form-control @error('phone') is-invalid @enderror" required type="text" name="phone"
                    placeholder="Phone *" wire:model="phone">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if (!Auth::check())
                <div class="form-group mb-3">
                    <input class="form-control @error('email') is-invalid @enderror" required type="text"
                        name="email" placeholder="Email address *" wire:model='email'>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

        </form>
    </div>
    <div class="col-md-6">
        <div class="order_review">
            <div class="heading_s1">
                <h4>Your Orders</h4>
            </div>
            <div class="table-responsive order_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->product->name }} <span class="product-qty">x
                                        {{ $cart->quantity }}</span>
                                </td>
                                <td>@rupiah($cart->quantity * $cart->product->price)</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SubTotal</th>
                            <td class="product-subtotal">@rupiah($totalCart)</td>
                        </tr>
                        <tr>
                            <th>Shipping {{ $delivery_fee != null ? '(' . $delivery_fee['etd'] . ' Days)' : '' }}</th>
                            <td>@rupiah($delivery_fee != null ? $delivery_fee['value'] : 0)</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td class="product-subtotal">@rupiah($totalCart + ($delivery_fee != null ? $delivery_fee['value'] : 0))</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="payment_method">
                <div class="heading_s1">
                    <h4>Payment</h4>
                </div>
                <div class="payment_option">
                    <div class="custome-radio">
                        <input class="form-check-input" required="" type="radio" name="payment_option"
                            id="exampleRadios3" value="option3" checked="">
                        <label class="form-check-label" for="exampleRadios3">Payment Gateway</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-fill-out btn-block" wire:click="checkout">Place Order</button>
        </div>
    </div>
</div>

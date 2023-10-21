<div class="cart_extra">
    <div class="cart-product-quantity">
        <div class="quantity">
            <input type="button" value="-" class="minus" wire:click='min'>
            <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4" wire:model='quantity'>
            <input type="button" value="+" class="plus" wire:click='plus'>
        </div>
    </div>
    <div class="cart_btn">
        <button class="btn btn-fill-out btn-addtocart" type="button" wire:click="addCart"><i class="icon-basket-loaded"></i> Add to
            cart</button>
    </div>
</div>

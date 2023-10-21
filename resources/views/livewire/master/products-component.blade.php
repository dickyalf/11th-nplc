@push('js')
    <script>
        if ($(".loadmore").length > 0) {
            $(".loadmore").isotope({
                layoutMode: 'fitRows',
                itemSelector: '.grid_item',
                percentPosition: true,
            });
        }
        window.addEventListener('loadmore', function() {
            $('.loadmore').isotope('destroy');
            if ($(".loadmore").length > 0) {
                $(".loadmore").isotope({
                    layoutMode: 'fitRows',
                    itemSelector: '.grid_item',
                    percentPosition: true,
                });
            }
            var elementHeight = $('.loadmore').height();
            $(window).scrollTop(elementHeight-600);
        });
    </script>
@endpush


<div>
    <div class="row loadmore">
        @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-6 grid_item">
                <div class="product">
                    <div class="product_img">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </a>
                        <div class="product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li class="add-to-cart"><a href="#" wire:click="addCart({{$product->id}})"><i class="icon-basket-loaded"></i> Add
                                        To Cart</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_info">
                        <h6 class="product_title"><a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                        <div class="product_price">
                            <span class="price">@rupiah($product->price)</span>
                        </div>
                        <div class="pr_desc">
                            <p>{{ Str::limit(strip_tags($product->name), 100) }}</p>
                        </div>
                        <div class="list_product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li class="add-to-cart" wire:click="addCart({{$product->id}})"><a href="javascript:void(0)"><i class="icon-basket-loaded"></i> Add</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center load_more_wrap">
        @if ($products->currentPage() != $products->lastPage())
            <button class="btn btn-fill-out" wire:loading.class='loading' wire:click='load'>Load
                More</button>
        @else
            <span class="alert alert-info">No More Item to Show</span>
        @endif

    </div>
</div>

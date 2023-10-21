@extends('layouts.user.master')

@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img id="product_img" src='{{ asset('storage/' . $product->image) }}'
                                data-zoom-image="{{ asset('storage/' . $product->image) }}" alt="product_img1" />
                            <a href="#" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title"><a href="#">{{ $product->name }}</a></h4>
                            <div class="product_price">
                                <span class="price">@rupiah($product->price)</span>
                            </div>
                            <div class="pr_desc">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                        <hr />
                        @livewire('master.add-cart-component', ['product_id' => $product->id])
                        <hr />
                        <ul class="product-meta">
                            <li>Stock: <a href="#">{{ $product->quantity }}</a></li>
                            <li>SKU: <a href="#">{{ $product->id }}</a></li>
                            <li>Category: <a href="#">{{ $product->category == 0 ? 'Softfile' : 'Hardfile' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description"
                                    role="tab" aria-controls="Description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info"
                                    role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                aria-labelledby="Description-tab">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane fade" id="Additional-info" role="tabpanel"
                                aria-labelledby="Additional-info-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Capacity</td>
                                        <td>{{ $product->weight }} gram</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $product->category == 0 ? 'Softfile' : 'Hardfile' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Releted Products</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20"
                        data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        @foreach ($relateds as $related)
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="{{ route('product.detail', ['id' => $related->id]) }}">
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="related">
                                        </a>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="{{ route('product.detail', ['id' => $related->id]) }}">{{$related->name}}</a>
                                        </h6>
                                        <div class="product_price">
                                            <span class="price">@rupiah($related->price)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection

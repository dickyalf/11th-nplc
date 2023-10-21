@extends('layouts.user.master')


@section('content')
    <!-- START SECTION BANNER -->
    <div class="section pb_20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="single_banner">
                        <img src="{{asset('assets/images/shop_banner_img1.png')}}" alt="shop_banner_img1" />
                        <div class="single_banner_info">
                            <h5 class="single_bn_title">Soft File Category</h5>
                            <a href="{{ route('products') }}" class="single_bn_link">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single_banner">
                        <img src="{{asset('assets/images/shop_banner_img2.png')}}" alt="shop_banner_img1" />
                        <div class="single_banner_info">
                            <h5 class="single_bn_title">Hard File Category</h5>
                            <a href="{{ route('products') }}" class="single_bn_link">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BANNER -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>Latest Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                            <div class="row shop_container">
                                @foreach ($latestProducts as $product)
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="product">
                                            <div class="product_img">
                                                <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="product_img1">
                                                </a>
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_title"><a
                                                        href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </h6>
                                                <div class="product_price">
                                                    <span class="price">@rupiah($product->price)</span>
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
        </div>
    </div>
    <!-- END SECTION SHOP -->
    <!-- START SECTION TESTIMONIAL -->
    <div class="section bg_redon">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>Our Client Say!</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2"
                        data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true"
                        data-items='1'>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>paket komik yg ditangani pecinta komik... jadinya super aman, meski cuman 1 komik... sippp... 😸👍🏼</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{asset('media/avatars/default-user.webp')}}" alt="user_img1" />
                                </div>
                                <div class="author_name">
                                    <h6>didik</h6>
                                    <span>Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>mantap gan. thx</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{asset('media/avatars/default-user.webp')}}" alt="user_img2" />
                                </div>
                                <div class="author_name">
                                    <h6>A***m</h6>
                                    <span>Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>mantap banget packingnya super aman👍</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{asset('media/avatars/default-user.webp')}}" alt="user_img3" />
                                </div>
                                <div class="author_name">
                                    <h6>H***t</h6>
                                    <span>Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION TESTIMONIAL -->


    <!-- START SECTION SHOP INFO -->
    <div class="section pb_70">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="flaticon-shipped"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>Fast Delivery</h5>
                            <p>Enjoy fast and reliable delivery on all your orders. With our efficient delivery service,
                                your orders will arrive quickly without compromising on quality. We are committed to
                                providing a convenient and satisfying shopping experience with leading delivery times.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="flaticon-money-back"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>30 Day Return</h5>
                            <p>Customer satisfaction is our top priority. If you are not completely satisfied with your
                                purchase, we offer a 30-day return policy. You can easily return your purchased item and get
                                a refund or exchange. We strive to make the returns process easy and transparent so that you
                                feel safe shopping at our store.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>27/4 Support</h5>
                            <p>We're here to help you with any questions, concerns or assistance you need. Available 24/7 to
                                help find products, manage orders or resolve technical issues. Contact us anytime for the
                                best customer service in real time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP INFO -->
@endsection

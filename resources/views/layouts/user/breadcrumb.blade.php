@if (isset($breadcrumb))
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        @foreach ($breadcrumb as $key => $value)
                            @if (is_numeric($key))
                                <li class="breadcrumb-item">{{ $value }}</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ $key }}">{{ $value }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->
@else
    <!-- START SECTION BANNER -->
    <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
        <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($slider as $slide)
                    <div class="carousel-item background_bg @if($loop->index ==0) active @endif" data-img-src="{{ asset('storage/' . $slide->image) }}">
                        <div class="banner_slide_content">
                            <div class="container">
                                <!-- STRART CONTAINER -->
                                <div class="row">
                                    <div class="col-lg-7 col-9">
                                        <div class="banner_content overflow-hidden">
                                            <h5 class="mb-3 staggered-animation font-weight-light"
                                                data-animation="slideInLeft" data-animation-delay="0.5s">{{$slide->subtitle}}</h5>
                                            <h2 class="staggered-animation" data-animation="slideInLeft"
                                                data-animation-delay="1s">{{$slide->title}}</h2>
                                            @if($slide->action_title && $slide->action_url)
                                                <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase"
                                                    href="{{$slide->action_url}}" data-animation="slideInLeft"
                                                    data-animation-delay="1.5s">{{$slide->action_title}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div><!-- END CONTAINER-->
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><i
                    class="ion-chevron-left"></i></a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><i
                    class="ion-chevron-right"></i></a>
        </div>
    </div>
    <!-- END SECTION BANNER -->
@endif

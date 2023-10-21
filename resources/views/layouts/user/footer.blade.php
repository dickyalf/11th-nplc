<!-- START FOOTER -->
<footer class="footer_dark">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img src="{{asset('media/logo.png')}}" alt="logo" height="50px"/></a>
                        </div>
                        <p>{{env("APP_DESCRIPTION")}}</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            <li><a href="{{route('contact')}}">About Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Category</h6>
                        <ul class="widget_links">
                            <li><a href="{{route('products')}}">Softfile</a></li>
                            <li><a href="{{route('products')}}">Hardfile</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Contact Info</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{env("APP_ADDRESS")}}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:{{env("APP_EMAIL")}}">{{env("APP_EMAIL")}}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{env("APP_PHONE")}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0 text-center text-md-start">© {{date("Y")}} All Rights Reserved by {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

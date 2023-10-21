<!-- START HEADER -->
<header class="header_wrap fixed-top header_with_topbar">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">

                        <div class="me-3">
                            <select name="currency" class="custome_select">
                                <option value='IDR' data-title="IDR">Rupiah</option>
                            </select>
                        </div>
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>{{env('APP_PHONE')}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-end">
                        <ul class="header_list">
                            @if (Auth::check())
                                <li><a href="{{ route('account') }}"><i class="ti-user"></i><span>{{ Auth::user()->name }}</span></a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="ti-user"></i><span>Login</span></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            @include('layouts.user.navbar')
        </div>
    </div>
</header>
<!-- END HEADER -->

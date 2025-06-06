        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header justify-content-lg-center">
                    <!-- Logo -->
                    <div>
                        <span class="smini-visible fw-bold tracking-wide fs-lg">
                            c<span class="text-primary">b</span>
                        </span>
                        <a class="link-fx fw-bold tracking-wide mx-auto" href="/">
                            <span class="smini-hidden">
                                <img src="{{asset('media/favicons/favicon.png')}}" alt="logo" height="30px"/>
                                <span class="fs-4 text-dual">Neo</span><span class="fs-4 text-primary">Paradigm</span>
                            </span>
                        </a>
                    </div>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->
                

                <!-- Sidebar Scrolling -->
                <div class="js-sidebar-scroll">
                    <!-- Side User -->
                    <div class="content-side content-side-user px-0 py-0">
                        <!-- Visible only in mini mode -->
                        <div class="smini-visible-block animated fadeIn px-3">
                            <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}"
                                alt="">
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="smini-hidden text-center mx-auto">
                            <a class="img-link" href="javascript:void(0)">
                                <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                            </a>
                            <ul class="list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a class="link-fx text-dual fs-sm fw-semibold text-uppercase"
                                        href="javascript:void(0)">{{ Auth::user()->name }}</a>
                                </li>
                                <li class="list-inline-item">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <a class="link-fx text-dual" data-toggle="layout" data-action="dark_mode_toggle"
                                        href="javascript:void(0)">
                                        <i class="fa fa-burn"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="link-fx text-dual" href="{{ route('auth.logout') }}">
                                        <i class="fa fa-sign-out-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/dashboard') ? ' active' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="nav-main-link-icon fa fa-house-user"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/slider') ? ' active' : '' }}"
                                    href="{{ route('admin.slider') }}">
                                    <i class="nav-main-link-icon fa fa-image"></i>
                                    <span class="nav-main-link-name">Slider</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/products') ? ' active' : '' }}"
                                    href="{{ route('admin.products') }}">
                                    <i class="nav-main-link-icon fa fa-bag-shopping"></i>
                                    <span class="nav-main-link-name">Products</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/users') ? ' active' : '' }}"
                                    href="{{ route('admin.users') }}">
                                    <i class="nav-main-link-icon fa fa-users"></i>
                                    <span class="nav-main-link-name">Users</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/characters') ? ' active' : '' }}"
                                    href="{{ route('admin.characters') }}">
                                    <i class="nav-main-link-icon fa fa-book"></i>
                                    <span class="nav-main-link-name">Characters</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link {{ request()->is('admin/invoices') ? ' active' : '' }}"
                                    href="{{ route('admin.invoices') }}">
                                    <i class="nav-main-link-icon fa fa-shopping-cart"></i>
                                    <span class="nav-main-link-name">Invoices</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </div>
            <!-- Sidebar Content -->
        </nav>
        <!-- END Sidebar -->

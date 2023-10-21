<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">
        <img class="logo_light" src="{{asset('media/logo.png')}}" alt="logo" height="50px"/>
        <img class="logo_dark" src="{{asset('media/logo.png')}}" alt="logo" height="50px" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-expanded="false">
        <span class="ion-android-menu"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li><a class="nav-link nav_item" href="/">Home</a></li>
            <li><a class="nav-link nav_item {{ request()->is('products') ? ' active' : '' }}"
                    href="{{ route('products') }}">Products</a></li>
            <li><a class="nav-link nav_item {{ request()->is('characters') ? ' active' : '' }}"
                    href="{{ route('characters') }}">Characters</a></li>
            <li><a class="nav-link nav_item {{ request()->is('invoices') ? ' active' : '' }}"
                    href="{{ route('invoices') }}">Invoices</a></li>
            <li><a class="nav-link nav_item {{ request()->is('contact') ? ' active' : '' }}" href="{{ route('contact') }}">About Us</a></li>
        </ul>
    </div>
    <ul class="navbar-nav attr-nav align-items-center">
        <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
            <div class="search_wrap">
                <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                <form>
                    <input type="text" placeholder="Search" class="form-control" id="search_input">
                    <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                </form>
            </div>
            <div class="search_overlay"></div>
        </li>
        @livewire('master.carts-component')
    </ul>
</nav>

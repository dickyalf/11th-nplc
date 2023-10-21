@extends('layouts.admin')
@section('content')
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo34@2x.jpg') }}');">
        <div class="row mx-0 bg-black-50">
            <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                <div class="p-4">
                    <p class="fs-3 fw-semibold text-white">
                        Get Inspired and Create.
                    </p>
                    <p class="text-white-75 fw-medium">
                        Copyright &copy; <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
            <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-body-extra-light">
                <div class="content content-full">
                    <!-- Header -->
                    <div class="px-4 py-2 mb-4">
                        <a class="link-fx fw-bold" href="#">
                            <span class="fs-4 text-body-color">Neo</span><span class="fs-4">Paradigm</span>
                        </a>
                        <h1 class="h3 fw-bold mt-4 mb-2">Welcome to {{env("APP_NAME")}}</h1>
                        <h2 class="h5 fw-medium text-muted mb-0">Please sign in</h2>
                    </div>
                    @yield('auth-content')
                    <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

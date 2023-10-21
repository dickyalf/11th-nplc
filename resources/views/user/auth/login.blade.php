@extends('layouts.user.master')


@section('content')
    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Login</h3>
                            </div>
                            @livewire('master.auth.login')
                            <div class="different_login">
                                <span> or</span>
                            </div>
                            <div class="form-note text-center">Don't Have an Account? <a href="{{route('register')}}">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->
@endsection

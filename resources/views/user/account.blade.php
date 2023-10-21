@extends('layouts.user.master')


@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard_menu">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail"
                                    role="tab" aria-controls="account-detail" aria-selected="true"><i
                                        class="ti-id-badge"></i>Account details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.logout') }}"><i class="ti-lock"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade active show" id="account-detail" role="tabpanel"
                            aria-labelledby="account-detail-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Account Details</h3>
                                </div>
                                @livewire('master.edit-account-component')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection

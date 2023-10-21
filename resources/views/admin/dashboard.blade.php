@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        @livewire('dashboard.statistic-component')
        @livewire('dashboard.charts-component')
    </div>
    <!-- END Page Content -->
@endsection

@extends('layouts.user.master')

@section('content')
    <!-- START SECTION Characters -->
    <div class="section">
        @livewire('master.characters-component')
    </div>
    <!-- END SECTION Characters -->
@endsection

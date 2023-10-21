@extends('layouts.user.master')

@section('content')
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_right">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="">Showing</option>
                                            <option wire:click='showing(8)'>8</option>
                                            <option vwire:click='showing(12)'>12</option>
                                            <option wire:click='showing(16)'>16</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @livewire('master.products-component')
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
@endsection

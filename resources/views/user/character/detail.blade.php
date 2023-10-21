@extends('layouts.user.master')

@section('content')
    <!-- START SECTION BLOG -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_post">
                        <h2 class="blog_title">{{$character->name}}</h2>
                        <ul class="list_none blog_meta">
                            <li><a href="#"><i class="ti-calendar"></i> {{ $character->created_at}} </a></li>
                        </ul>
                        <div class="blog_img">
                            <img src="{{ asset('storage/' . $character->image) }}" alt="blog_img1">
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                {!!$character->description!!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BLOG -->
@endsection

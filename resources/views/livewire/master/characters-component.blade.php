<div class="container">
    <div class="row">
        @foreach ($characters as $character)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="blog_post blog_style2 box_shadow1">
                    <div class="blog_img">
                        <a href="{{ route('character.detail', ['id' => $character->id]) }}">
                            <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}">
                        </a>
                    </div>
                    <div class="blog_content bg-white">
                        <div class="blog_text">
                            <h6 class="blog_title"><a href="{{ route('character.detail', ['id' => $character->id]) }}">{{ $character->name }}</a></h6>
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ti-calendar"></i> {{ $character->created_at }}</a></li>
                            </ul>
                            <p>{!! Str::limit(strip_tags($character->description), 100) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 mt-2 mt-md-4">
            <ul class="pagination pagination_style1 justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i
                            class="linearicons-arrow-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="linearicons-arrow-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

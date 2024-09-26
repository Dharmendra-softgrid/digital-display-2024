@extends('layouts.app')


@section('content')
    <main class="main_content">
        <section class="">
            @if (isset($sliders) && !empty($sliders))
                @foreach ($sliders as $i => $slider)
                    <div class="categories_top_banner">
                        <figure>
                            <img src="{{ asset(isset($slider->image) ? 'images/' . $slider->image : 'images/computerbanner.jpg') }}"
                                alt="banner">
                        </figure>
                        @if (!empty($slider->slide_title))
                            <div class="container relative">
                                <div class="top-banner-content">
                                    <h4>{{ $slider->slide_title }}</h4>
                                    <p>{!! $slider->slide_content !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </section>
        <section class="breadcrumb-sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="newsHome">Home</a></li>
                        <li class="breadcrumb-item">News & Blog</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="sec_padd case-study_sec pt-0">
            <div class="container">
                <div class="row">
                    @if ($newsrooms->isNotEmpty())
                        @foreach ($newsrooms as $i => $newsroom)
                            <div class="col-12 col-lg-3 mb-5">
                                <div class="newsroom_item">
                                    <a class="newslink" href="{{ $newsroom->link }}">
                                        <figure>
                                            <img src="{{ asset(isset($newsroom->image) ? 'images/' . $newsroom->image : 'images/computerbanner.jpg') }}"
                                                alt="news img">
                                        </figure>
                                    </a>
                                    <div class="item_body">
                                        @if(!empty($newsroom->link))
                                        <a class="newslink" href="{{ $newsroom->link }}">
                                            <h5>{{ $newsroom->title }} - </h5>
                                        </a>
                                        @else
                                        <h5>{{ $newsroom->title }}</h5>
                                        <div class="news_details">
                                            <span class="Publisher_name"> {{ $newsroom->publisher }}</span>
                                        </div>

                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

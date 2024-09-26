@extends('layouts.app')


@section('content')
    <?php //print_r($successstory);
    ?>
    <main class="main_content">
        <section class="">
            @if (isset($sliders) && !empty($sliders))
                @foreach ($sliders as $i => $slider)
                    <div class="categories_top_banner">
                        <figure>
                            <img src="{{ asset(isset($slider->iimage) ? 'images/' . $slider->iimage : 'images/computerbanner.jpg') }}"
                                alt="banner">
                        </figure>
                        @if (!empty($slider->ititle))
                            <div class="container relative">
                                <div class="top-banner-content">
                                    <h4>{{ $slider->ititle }}</h4>
                                    <p>{!! $slider->icontent !!}</p>
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
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Success Stories</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $successstory->title }}</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="sec_padd case-study-details pt-0">
            <div class="container">
                <div class="col-md-12">
                    <div class="case-study-content">
                        <h1>{{ $successstory->title }}</h1>
                        <p class="mt-2">{{ $successstory->short_description }}</p>


                        {{-- <div class="company-profile mt-5">
                <div class="row">
                  <div class="col-md-4">
                    <div class="company-details">
                      <h5>Client Name/ Company/ Firm</h5>
                      <p>{{$successstory->company}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="company-details">
                      <h5>Year of the project</h5>
                      <p>{{$successstory->year}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="company-details">
                      <h5>Type</h5>
                      <p>{{$successstory->type}}</p>
                    </div>
                  </div>
                </div>
              </div> --}}
                        <div class="project-overview mt-5">
                            {!! $successstory->content !!}
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="sec_padd gray-bg product_project">
            <div class="container">
                <div class="head_cmn text-center">
                    <h2 class="head_2">PRODUCT USED IN THIS PROJECT</h2>
                </div>
                <div class="row">
                    @if ($products->isNotEmpty())
                        @foreach ($products as $i => $p)
                            <div class="col-md-6 col-lg-3 col-xl-3">
                                <div class="product">
                                    <div class="product_img">
                                        <figure>
                                            <img src="{{ asset(isset($p->featured_image) ? 'images/' . $p->featured_image : 'images/computerbanner.jpg') }}" alt="product img">
                                        </figure>
                                    </div>
                                    <div class="product_details">
                                        <div class="product_code">{{ $p->model }}</div>
                                        <div class="product_name">
                                            <h4>{{ $p->title }}</h4>
                                        </div>
                                        <div class="product_des">
                                            <p>{{ $p->title }}</p>
                                        </div>
                                        <a href="{{ url('product/' . $p->slug) }}" class="inquire-now-btn">ENQUIRE NOW</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="product_details">
                            <p>No products found</p>
                        </div>
                    @endif
                </div>
            </div>

        </section>



    </main>
@endsection

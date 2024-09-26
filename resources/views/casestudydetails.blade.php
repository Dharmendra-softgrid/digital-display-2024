@extends('layouts.app')


@section('content')
<main class="main_content">
  <section class="">
    <div class="categories_top_banner">
      <figure>
        <img src="{{asset(isset($slider->image) ? 'images/'.$slider->image : 'images/computerbanner.jpg')}}" alt="banner">
      </figure>
      @if(!empty($slider->slide_title))
            <div class="container relative">
              <div class="top-banner-content">
                <h4>{{$slider->slide_title}}</h4>
                <p>{!! $slider->slide_content !!}</p>
              </div>
            </div>
          @endif
    </div>
  </section>
  <section class="breadcrumb-sec">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="{{route('case-study')}}" class="newsHome">Case study</a></li>
          <li class="breadcrumb-item active">Case study details</li>
          <!-- <li class="breadcrumb-item active" aria-current="page">ipro cameras</li> -->
        </ol>
      </nav>
    </div>
  </section>
  <section class="sec_padd case-study-details pt-0">
    <div class="container">
      <div class="col-md-12">
        <div class="case-study-content">
          <h1>{{$casestudiesdetails->title}}</h1>
          <p class="mt-2">{!!$casestudiesdetails->short_description!!}</p>

          <div class="company-profile mt-5">
            <div class="row">
              <div class="col-md-4">
                <div class="company-details">
                  <h5>Client Name/ Company/ Firm</h5>
                  <p>{{$casestudiesdetails->client_name}}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="company-details">
                  <h5>Year of the project</h5>
                  <p>{{$casestudiesdetails->project_year}}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="company-details">
                  <h5>Type</h5>
                  <p>{{$casestudiesdetails->project_type}}</p>
                </div>
              </div>
            </div>
          </div>
    <div class="project-overview mt-5">
      {!! $casestudiesdetails->content !!}
      
    </div>

    </div>
    </div>
    </div>
  </section>
  @if($products->isNotEmpty())
    <section class="sec_padd gray-bg recommended_product">
      <div class="container">
        <div class="head_cmn text-center">
          <h2 class="head_2">PRODUCT USED IN THIS PROJECT</h2>
        </div>
        <div class="row">
          @foreach($products as $i=>$p) 
            <div class="col-md-6 col-lg-3 col-xl-3">
              <div class="product">
                <div class="product_img">
                  <figure>
                    <img src="{{asset('/')}}images/CaseStudy2.jpg" alt="product img">
                  </figure>
                </div>
                <div class="product_details">
                  {{-- <div class="product_code">{{$p->title}}</div> --}}
                  <div class="product_name">
                    <h4>{{$p->title}}</h4>
                  </div>
                  <div class="product_des">
                    <p>{{$p->short_description}}</p>
                  </div>
                  <a href="#" class="inquire-now-btn">INQUIRE NOW</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</main>
@endsection
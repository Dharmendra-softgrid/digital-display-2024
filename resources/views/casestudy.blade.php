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
            <li class="breadcrumb-item"><a href="{{url('/')}}" class="newsHome">Home</a></li>
            <li class="breadcrumb-item active">Case study</li>
            <!-- <li class="breadcrumb-item active" aria-current="page">ipro cameras</li> -->
          </ol>
        </nav>
      </div>
    </section>

    <section class="sec_padd case-study-sec pt-0">
      <div class="container">
        
        <div class="row">
          @if($casestudies->isNotEmpty())
          @foreach($casestudies as $i=>$cs) 
            <div class="col-12 col-lg-4 ">
              <div class="product_item">
                <figure>
                  <img src="{{asset(isset($cs->image) ? 'images/'.$cs->image : 'images/computerbanner.jpg')}}">
                </figure>
                <div class="item_body">
                  <h5>{{$cs->title}}</h5>
                  <p>{!! $cs->short_description !!}</p>
                  <div class="know_more-link text-start btn-effect">
                    <a href="{{ url('case-study-details/'.$cs->slug) }}">KNOW MORE</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endif
      </div>
    </section>

    



  </main>
  @endsection
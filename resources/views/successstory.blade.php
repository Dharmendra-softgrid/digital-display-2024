@extends('layouts.app')


@section('content')
<main class="main_content">
      <section class="">
      @if($sliders->isNotEmpty())
        @foreach($sliders as $i=>$slider)
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
        @endforeach
      @endif
      </section>
      <section class="breadcrumb-sec">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Success Stories</li>
              <!-- <li class="breadcrumb-item active" aria-current="page">ipro cameras</li> -->
            </ol>
          </nav>
        </div>
      </section>

      <section class="sec_padd case-study-sec pt-0">
        <div class="container">
          <div class="row">
            @if($successstories->isNotEmpty())
              @foreach($successstories as $i=>$successstory)            
              <div class="col-12 col-lg-3 mb-5">
                <div class="product_item">
                  <figure>
                    <img src="{{asset(isset($successstory->banner_image) ? 'images/'.$successstory->banner_image : 'images/computerbanner.jpg')}}" alt="blog img">
                  </figure>
                  <div class="item_body">
                    <h5>{{$successstory->title}}</h5>
                    {{-- <p>{{$successstory->short_description}}</p> --}}
                    <div class="know_more-link text-start btn-effect">
                      <a href="{{ url('success-story-details/'.$successstory->slug) }}">KNOW MORE</a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>
      {{-- <section class="industry_sec sec_padd blue-bg">
        <div class="container">
      
          <div class="row align-items-center">
            <!-- User this HTML for Slider -->
            <div class="industry_banner banner-content clearfix">
              <div class="banner-slider">
      
      
                    <div class="slider slider-for">
                      <div class="slider-banner-image">
                        <div class="video-content embed-responsive embed-responsive-16by9">
                          <iframe id="video_youtube" class="yt_players video-iframe embed-responsive-item" width="100%" height="auto" 
                          src="https://www.youtube.com/embed/T81FPr66ucI?si=44mJ-ffG03uuM0w3?version=3&enablejsapi=1&rel=0" frameborder="0" allowfullscreen>
                                  </iframe>
                        </div>
                      </div>
                    </div>
      
                    <div class="slider slider-nav thumb-image industry_banner_thumb">
                      
                      @if($videoLink->isNotEmpty())
                      
                              @foreach($videoLink as $i=>$vl)
                        
                        <div class="thumbnail-image active relAdd" >
                          <div class="thumbImg">
                            <img src="{{asset(isset($vl->thumbnail) ? 'images/'.$vl->thumbnail : 'images/computerbanner.jpg')}}" alt="industry img">
                            <input type="hidden" id="videoURL" value="{{$vl->link}}">
      
                          </div>
                          
                        </div>
                        @endforeach
                      @endif	
                    </div>
      
      
                </div>
            </div>
            <!-- End User this HTML for Slider -->
          </div>
        </div>
      </section> --}}
    </main>          
@endsection
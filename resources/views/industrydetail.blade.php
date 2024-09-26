@extends('layouts.app')


@section('content')
<main class="main_content">
      <section class="top-inner-banner">
        <div class="top_banner_slider top_banner_images">

          @if (isset($sliders) && !empty($sliders))
            @foreach($sliders as $i=>$slider)
              <div class="banner_slide">
                <div class="banner_slide_img">
                    <figure>
                      <img src="{{asset(isset($slider->bimage) ? 'images/'.$slider->bimage : 'images/computerbanner.jpg')}}" alt="banner">
                    </figure>
                </div>
                <div class="banner_slide_caption">
                    @if(!empty($slider->btitle))
                      <div class="container relative">
                        <div class="top-banner-content">
                          <h4>{{$slider->btitle}}</h4>
                          <p>{!! $slider->bcontent !!}</p>
                        </div>
                      </div>
                    @endif
                </div>
              </div>
            @endforeach
          @endif
        <!-- slid end -->
        </div>
      </section>

    <section class="Industry_content_sec sec_padd pb-0">
      <div class="container">
        <div class="head_cmn text-center1">
            <h3 class="panasonic_text">{{$industry->heading}}</h3>
        </div>
        <div class="content text-center1">
          <p>{!! strip_tags($industry->content) !!}</p>
        </div>
        
      </div>
    </section>

      <section class="Industry_content_sec sec_padd pt-0">
      <div class="container">
        @if($industryDetail->isNotEmpty())
        @foreach($industryDetail as $index=>$value) 
        <div class="row panasonic_service_row">
            <div class="col-md-4">
                <div class="panasonic_img">
                  <img src="{{asset('images/'.$value->image)}}" alt="INDUSTRIES IMG">
                </div>  
            </div>
            <div class="col-md-8">
                <div class="panasonic_text">
                  <h3>{{$value->title}}</h3>
                  <p>{!!$value->content!!}</p>
                </div>
            </div>
        </div>
        @endforeach
        @endif
      </div>
    </section>
    <section class="SinageSolutionsSec">
      <div class="container">
        <div class="display_box SinageSolutions">
          @if(!empty($IndustryBlog->isNotEmpty()))
            @foreach ($IndustryBlog as $relatedBlog)
              <div class="display_banner display_hover_top">
                <figure>
                  <img src="{{asset(isset($relatedBlog->image) ? 'images/'.$relatedBlog->image : 'images/computerbanner.jpg')}}">
                </figure>
                <div class="text-caption">
                  <div class="text-caption-content">
                    <h3>{{$relatedBlog->title}}</h3>
                    {!! $relatedBlog->description !!}
                      <a href="#" class="btn View-all-btn common-btn">View All  <span>&#x2192;</span></a>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>
    @if(!empty($relatedProducts->isNotEmpty()))
    <section class="sec_padd product-finder-sec pt-0">
      <div class="container">
        <div class="head_cmn text-center">
            <h2 class="head_2">PRODUCT FINDER</h2>
        </div>
        <div class="product_finder_slider slider-arrow">
        @if(!empty($relatedProducts->isNotEmpty()))
          @foreach($relatedProducts as $relatedProduct)
          <div class="poduct_finder_block">
              <div class="row">
                  <div class="col-md-6 product_image_row">
                      <div class="product_image">
                                <figure>
                                   <img src="{{asset(isset($relatedProduct->featured_image) ? 'images/'.$relatedProduct->featured_image : 'images/computerbanner.jpg')}}" alt="product img">
                                </figure>
                      </div>
                  </div>
                  <div class="col-md-6 product_details_right_col">
                      <div class="product_details">
                        <h3>{{$relatedProduct->title}}</h3>
                         <p>{{$relatedProduct->short_description}}</p>
                          <a href="{{ url('product/'.$relatedProduct->slug) }}" class="see_details">See details <span>&#x2192;</span></a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- slide -->
          @endforeach
        @endif
        </div>
      </div>
    </section>
    @endif

<!-- <section class="SinageSolutionsSec">
  <div class="container">
    <div class="display_box SinageSolutions">
               <div class="display_banner display_hover_top">
                 <figure>
                    <img src="assets/images/SinageSolutions.jpg">
                </figure>
                <div class="text-caption">
                  <h3>Sinage Solutions</h3>
                 <p>Effortlessly deliver better, more engaging content to your audience with a fully integrated Digital Signage solution.</p>
                  <a href="#" class="btn View-all-btn common-btn">View All</a>
                  
                </div>
               </div>
            </div>
  </div>
</section> -->
  

<section class="industry_service sec_padd">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">OTHER INDUSTRIES</h2>
		</div>
		<?php //echo"<pre>";print_r($industries);echo"</pre>";?>
		<div class="row align-items-center">
		@if($industries->isNotEmpty())
            @foreach($industries as $i=>$industry)
			<div class="col-md-6 col-lg-3 col-6">
				<div class="industry_service_block">
					<div class="icon"><img src="{{asset(isset($industry->banner_image) ? 'images/'.$industry->banner_image : 'images/computerbanner.jpg')}}"></div>
					<h4><a style="color: black" href="{{route('industry', ['slug' => $industry->slug])}}">{{$industry->title}} </a></h4>
				</div>
			</div>
			@endforeach
		@endif			
		</div>
	</div>
</section>




    </main>
@endsection
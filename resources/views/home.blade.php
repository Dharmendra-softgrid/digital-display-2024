
@extends('layouts.app')


@section('content')

<section class="top_banner">
	<div class="home_banner_sec">
		
			@if($videos->isNotEmpty())
			  @foreach($videos as $i=>$video)
			  
				<div class="home_banner_content">
				  	<div class="banner_caption">
					  <!-- <h3>{{$video->title}}</h3> -->
						<h3><span>Change Work,</span>
						  <span>Advance Society,</span>
						  <span>Connect to Tomorrow</span>
						</h3>
						
				  	</div>

				  	<div class="banner_video">
						<video autoplay="" id="video" loop="" muted="" playsinline="" poster="https://content.connect.panasonic.com/jp-ja/fai/36780/raw" webkit-playsinline=""><source src="{{asset(isset($video->video) ? 'videos/'.$video->video : '...')}}"><p>Unable to play video.</p>
						</video>
						<div class="banner_img">
							<img src="{{asset(isset($slider->image) ? 'images/'.$slider->image : 'images/computerbanner.jpg')}}">
						</div>
			  
					</div>
			  </div>
			  @endforeach
		  @endif

  </div>
</section>

<section class="solution_sec ">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">{{$first_sec_content->title ?? ''}}</h2>
			<div class="sec_p text-center">
					<p>{!! $first_sec_content->content ?? '' !!}</p>
				</div>
		</div>
	<!-- 	<div class="row">
			<div class="col-md-12 mx-auto">
				
			</div>
		</div> -->
	</div>		
</section>

<section class="home_about_sec sec_padd gray-bg">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">{{$second_sec_content->title}}</h2>
		</div>
		<div class="row">
			@if($homeDisplaySolution->isNotEmpty())
				@foreach($homeDisplaySolution as $i=>$vl)
				
				<div class="col-6 col-lg-3 col-md-6 mb-5">
					<div class="solution_item ">
						<figure>
							<img src="{{asset(isset($vl->image) ? 'images/'.$vl->image : 'images/computerbanner.jpg')}}" alt="blog img">
						</figure>
						<div class="item_body">
							<div class="content">
								<h3>{{$vl->title}}</h3>
								<div>{!! $vl->short_desc_home !!}</div>
							</div>
							<div class="know_more-link text-start btn-effect">
								@if($i == 3)
								<a href="#" class="link">
									Know More 
									<!-- <span class="arrow-right"><img src="{{asset('/')}}images/Icon-arrow-right.svg"></span> -->
								</a>
								
								@elseif($i == 6)
								<a href="https://pro-av.panasonic.net/en/" class="link">
									Know More  <i class="fas fa-external-link-alt" style="margin-left: 5px;"></i>
								</a>
								@else
								<a href="{{route('mainmenu', [ 'slug' => $vl->slug])}}" class="link" >
									Know More 
									<!-- <span class="arrow-right"><img src="{{asset('/')}}images/Icon-arrow-right.svg"></span> -->
								</a>
								@endif
								
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@endif
			
		</div>
	</div>
</section>

<section class="industry_sec sec_padd blue-bg">
	<div class="container">

		<div class="head_cmn text-center white-text">
			<h2 class="head_2">{{$third_sec_content->title}}</h2>
			<p>{!! $third_sec_content->content !!}</p>
		</div>

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
</section>

<section class="industry_service sec_padd">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">{{$fourth_sec_content->title}}</h2>
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

<section class="case_studies sec_padd gray-bg Success_stories">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">{{$fifth_sec_content->title}}</h2>
			<p>{{strip_tags($fifth_sec_content->content)}}</p>
		</div>

		<div class="case_studies_slider">		
		@if($successstories->isNotEmpty())
            @foreach($successstories as $i=>$successstory)
			<div class="product_slide">
				<div class="product_item">
					<figure>
						<img src="{{asset(isset($successstory->banner_image) ? 'images/'.$successstory->banner_image : 'images/computerbanner.jpg')}}" alt="case studies">
					</figure>
					<div class="item_body">
						<h3>{{$successstory->title}}</h3>
						<div class="know_more-link text-start btn-effect">
							<a href="{{ url('success-story-details/'.$successstory->slug) }}">Read More</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		@endif			
		</div>
	</div>
</section>

<section class="newsroom_sec sec_padd ">
	<div class="container">
		<div class="head_cmn text-center">
			<h2 class="head_2">{{$sixth_sec_content->title}}</h2>
		</div>
		<div class="row">
			<div class="col-md-6 col-12">
			@if($newsrooms->isNotEmpty())
            	@foreach($newsrooms as $i=>$newsroom)
					@if ($loop->iteration == 2)
						@break
					@endif
				<div class="news_block">
					<div class="news_thumbnail new_left">
						<figure>
							<img src="{{asset(isset($newsroom->image) ? 'images/'.$newsroom->image : 'images/computerbanner.jpg')}}"/>
						</figure>
						<div class="news-content">
							<h4>{{$newsroom->title}}</h4>
							<a href="{{$newsroom->link}}" class="btn read_more">Know More</a>
						</div>
					</div>
				</div>
				@endforeach
			@endif
			</div>

			<div class="col-md-6 col-12">
				<div class="news_right row">
				@if($newsrooms->isNotEmpty())
            		@foreach($newsrooms as $i=>$newsroom)
						@if ($loop->first)
							@continue
						@endif
						<div class="col-md-12">
							<div class="news_block">
								<div class="news_thumbnail_list news_right">
									<figure>
										<img class="newsAndMediaImgstyle" alt="Image Description" src="{{asset(isset($newsroom->image) ? 'images/'.$newsroom->image : 'images/computerbanner.jpg')}}"/>
									</figure>
									<div class="news-content">
										<h4>{{$newsroom->title}}</h4> - By <span>{{$newsroom->publisher}}</span></br>
										<a href="{{$newsroom->link}}" class="btn read_more">Know More</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@endif					
				</div>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	
	  if ( $('.slider-for-product').length ) {
  
      $('.slider-for-product').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          asNavFor: '.product-thumb-image'
      });

      $('.product-thumb-image').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          vertical:true,
          // asNavFor: '.slider-for-product',
          dots: false,
          responsive: [
          {
              breakpoint: 992,
              settings: {
                vertical: false,
              }
          },
          {
            breakpoint: 768,
            settings: {
              vertical: false,
            }
          },
          {
            breakpoint: 580,
            settings: {
              vertical: false,
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 380,
            settings: {
              vertical: false,
              slidesToShow: 3,
            }
          }
          ]
      });
  }




   $(".industry_banner_thumb .thumbnail-image").on("click",function(){
       $(".industry_banner_thumb .thumbnail-image").removeClass("active");
       $(this).addClass("active");
       $("#video_youtube").attr("src","https://www.youtube.com/embed/"+$(this).attr("rel")+"?version=3&enablejsapi=1&rel=0");
  });
  $(document).ready(function() { 
    $('.relAdd').each(function() {
        // Get the value of the videoURL input field for the current element
        var url = $(this).find('#videoURL').val();
        
        // Ensure the url is not empty before further processing
        if (url) {
            // Extract the video ID from the URL
            var videoId = url.split('embed/').pop().split('?')[0];

            // Add the rel attribute to the current element
            $(this).attr('rel', videoId);
        }
    });
});




 // end
</script>

          
@endsection

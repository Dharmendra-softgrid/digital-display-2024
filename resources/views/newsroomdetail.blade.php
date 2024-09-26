@extends('layouts.app')


@section('content')
<!-- <pre><?php //print_r($previous);?></pre> -->
<style>
.newroom-next-prev-block a.read-btn {
    display: inline-block;
}
.col-md-6.next_ {
    text-align: right;
}
.col-md-6.previous_ {
    text-align: left;
}
</style>
<main class="main_content">
      <section class="">
        <div class="categories_top_banner">
          <figure>
            <img src="{{asset(isset($newsroom->image) ? 'images/'.$newsroom->image : 'images/computerbanner.jpg')}}" alt="banner">
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
              <li class="breadcrumb-item"><a href="{{route('newsroom')}}" class="newsHome">Blog & News</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$newsroom->title}}</li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="sec_padd pt-0 pb-0">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="newroom-details-content">
                <h1>{{$newsroom->title}}</h1>
                {!!$newsroom->content!!}               
              </div>
              <!-- newroom-details-content end -->
            </div>
          </div>
        </div>
      </section>

      <section class="sec_padd">
        <div class="container">
          <div class="newroom-next-prev-block">
            
            <div class="col-md-6 previous_">
            @if($previous)
              <a href="{{ url('newsRoomDetail/'.$previous->slug) }}" class="read-btn read-prev"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Read Previous </a>
              @endif
            </div>
            
            
            <div class="col-md-6 next_">
            @if($next)
              <a href="{{ url('newsRoomDetail/'.$next->slug) }}"  class="read-btn read-next">Read Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
              @endif
            </div>
            
        </div>
      </section>


      <section class="sec_padd case-study_sec pt-0">
        <div class="container">          
          <div class="row">
          @if($newsrooms->isNotEmpty())
            @foreach($newsrooms as $i=>$newsroom) 
            <div class="col-12 col-lg-4 mb-5">
              <div class="newsroom_item">
              <a class="newslink" href="{{ url('newsRoomDetail/'.$newsroom->slug) }}">
                <figure>
                  <img src="{{asset(isset($newsroom->image) ? 'images/'.$newsroom->image : 'images/computerbanner.jpg')}}" alt="news img">
                </figure>
              </a>
                <div class="item_body">
                <a class="newslink" href="{{ url('newsRoomDetail/'.$newsroom->slug) }}"><h5>{{$newsroom->title}}</h5></a>
                  <div class="news_details">
                    <span class="news_date"> {{date('M d, Y', strtotime($newsroom->created_at))}} </span> | <span class="Publisher_name"> {{$newsroom->publisher}}</span>
                  </div>
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
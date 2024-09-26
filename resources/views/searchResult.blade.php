@extends('layouts.app')


@section('content')
<main class="main_content">
     
    
    <br><section class="Industry_content_sec ">
      <div class="container">
        <div class="head_cmn text-center1">
            <h3 class="panasonic_text">Search Results For "{{$input}}"</h3>
        </div>
      </div>
    </section>
    <hr><section class="Industry_content_sec ">
        <div class="container">
            @if(isset($searchData['products']) && !$searchData['products']->isEmpty() || isset($searchData['news']) && !$searchData['news']->isEmpty() || isset($searchData['about']) && !$searchData['about']->isEmpty() || isset($searchData['successStories']) && !$searchData['successStories']->isEmpty() || isset($searchData['industries']) && !$searchData['industries']->isEmpty() || isset($searchData['home']) && !$searchData['home']->isEmpty())
                @foreach ($searchData as $type => $results)
                    @foreach ($results as $item)
                        <div class="row search_now">
                            <div class="col-md-2">
                                <div class="panasonic_img">
                                    @if($type === 'news')
                                        <img class="search_img" src="{{asset(isset($item->image) ? 'images/'.$item->image : 'images/computerbanner.jpg')}}" alt="news img">
                                    @elseif($type === 'products')
                                        <img class="search_img" src="{{ asset(isset($item->featured_image) ? 'images/'.$item->featured_image : 'images/computerbanner.jpg') }}">
                                    @elseif($type === 'successStories')
                                        <img class="search_img" src="{{ asset(isset($item->banner_image) ? 'images/'.$item->banner_image : 'images/computerbanner.jpg') }}">
                                    @elseif($type === 'industries')
                                        <p style="font-size: 20px;font-weight: 400; text-transform: uppercase;">{{$item->title}}</p>
                                    @elseif($type === 'about')
                                        <p style="font-size: 20px;font-weight: 400;">ABOUT US</p>
                                    @elseif($type === 'home')
                                        <p style="font-size: 20px;font-weight: 400;">HOME</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="panasonic_text">
                                    @if($type !== 'industries')
                                        <p>{!! $item->title !!}</p>
                                    @endif
                                    @if($type === 'about')
                                        <div class="product_des"><p>{!! $item->content !!}</p></div>
                                    @elseif($type === 'home')
                                        <div class="product_des"><p>{!! $item->content !!}</p></div>
                                    @elseif($type === 'products')
                                        <div class="product_des"><p>{{$item->short_description}}</p></div>
                                    @elseif($type === 'successStories')
                                        <div class="product_des"><p>{{$item->short_description}}</p></div>
                                    @elseif($type === 'news' && !empty($item->publisher))
                                        <div class="pro_size"> By - {{ $item->publisher }}</div>
                                    @elseif($type === 'industries')
                                        <div class="product_des"><p>{!! $item->content !!}</p></div>
                                    @endif
                                    <div class="search-footer align-left">
                                        @if($type === 'products')
                                            <a href="{{ url('product/'.$item->slug) }}" style="color: black; float: right;">Read More</a>
                                        @elseif($type === 'news')
                                            <a href="{{ $item->link }}" style="color: black; float: right;">Read More</a>
                                        @elseif($type === 'about')
                                            <a href="{{ url('aboutus/') }}" style="color: black; float: right;">Read More</a>
                                        @elseif($type === 'successStories')
                                            <a href="{{ url('success-story-details/'.$item->slug) }}" style="color: black; float: right;">Read More</a>
                                        @elseif($type === 'industries')
                                            <a href="{{ url('industry/'.$item->slug) }}" style="color: black; float: right;">Read More</a>
                                        @elseif($type === 'home')
                                            <a href="{{ url('/') }}" style="color: black; float: right;">Read More</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    @endforeach
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="panasonic_text">
                        <h3>Hmmm...</h3>
                        <h4>We couldn't find any matches for "{{$input}}"</h4>
                        <div class="pro_size"> 
                            Double check your search for any type of spelling errors - or try a different search term.
                        </div>
                    </div>
                </div><br>
            @endif
        </div>
      </section>
    </main>
@endsection
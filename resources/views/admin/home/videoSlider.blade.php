@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <style type="text/css">
    .tox-promotion,.tox-statusbar__branding{
      display: none;
    }
    .addimage{
      cursor: pointer;
    }
    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .select2 {
    width:100%!important;
    }
  </style>
@endsection
@section('content')

    <div class="pagetitle">
      <h1>Home Page slider</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Video Slider</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<section class="section">
  <div class="card">
    <div class="card-body">
      @include('admin.shared.displaymsg')
      <h5 class="card-title">Home Page slider</h5>
      <form method="POST" action="{{route('home.video.slider.save')}}">
        <div class="row">
          <div class="col-lg-12">
            <!-- Horizontal Form -->
            {{ csrf_field() }}
            <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Video</label>
                  <div class="col-sm-10">               
                    @include('admin.shared.addvideo',['videos'=>(isset($sliderVideos) && $sliderVideos->isNotEmpty()) ? $sliderVideos : '','key'=>'svalue'])
                  </div>
              </div>
           
             
          </div>
          <div class="row">
            <div class="col-sm-10 offset-sm-2">  
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </form><!-- End Horizontal Form -->
    </div>
  </div>
</section>

@include('admin.shared.videopopup')
@endsection
@section('scripts')

<script type="text/javascript" src="{{asset('/')}}assets/js/addvideo.js"></script>
@endsection

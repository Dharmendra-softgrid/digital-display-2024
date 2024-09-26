@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <style type="text/css">
    .tox-promotion,.tox-statusbar__branding{
      display: none;
    }
  </style>
@endsection

@section('content')
<div class="newsroomtitle">
      <h1>Newsrooms</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Newsrooms</li>
          <li class="breadcrumb-item active">Banner</li>
        </ol>
      </nav>
    </div><!-- End newsroom Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('newsroom.banner.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}           
                <div class="row mt-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Banner Image <br> <small style="font-size;11px;">(1920x640)</small></label>
                  <div class="col-sm-10">
                    <div class="card ">
                       
                        <img src="{{asset(isset($banner->svalue) ? 'images/'.$banner->svalue : 'images/computerbanner.jpg')}}" class="card-img-top" alt="..." id="bannerimagepreview">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                        </div>
                      </div>
                      @if($errors->has('bannerimage'))
                        <div class="text-danger">{{ str_replace("bannerimage","banner image",$errors->first('bannerimage'))  }}</div>
                    @endif
                    <div class="msg"></div>
                  </div>

                </div>
                <input type="file" name="bannerimage" accept="image/png, image/jpeg, image/jpg, image/gif" id="bannerimage" class="d-none">
                <div class="row">
                  <div class="col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                </div>
                  
                </div>
              </form>
            </div>
          </div>

        </div>

       
      </div>
    </section>


@endsection
@section('scripts')

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#addbannerimage').click(function(){
      $('#bannerimage').click();
    });
    $('#bannerimage').change(function(){
        const file = this.files[0];
        var sizeKB = file.size / 1024;
        
        if(sizeKB > 2048){
          $('.msg').html('<div class="text-danger">The banner image may not be greater than 2048 kilobytes</div>');
          return;
        }else if (!file.name.match(/\.(jpg|jpeg|png|gif)$/) ){
          $('.msg').html('<div class="text-danger">The banner image must be a file of type: jpeg, png, jpg, gif.</div>');
          return;

        }else{
          $('.msg').html('');
        }
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#bannerimagepreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
  });
</script>

@endsection
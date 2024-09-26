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
   
  </style>
@endsection
@section('content')

    <div class="pagetitle">
      <h1>Home page slider</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Image slider</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<section class="section">
  <div class="card">
    <div class="card-body">
      @include('admin.shared.displaymsg')
      <h5 class="card-title">Home Page Slider</h5>
      <form method="POST" action="{{route('home.image.slider.save')}}">
        <div class="row">
          <div class="col-lg-12">
            <!-- Horizontal Form -->
            {{ csrf_field() }}
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Desktop Slider Images <br><small style="font-size:11px;">dimension(1920x363)</small></label>
              <div class="col-sm-10">               
                <div class="row " id="imagesortable">
                  @if(isset($destopImages) && $destopImages->isNotEmpty())
                    @foreach($destopImages as $pimage)
                      <div class="col-sm-6 col-md-3">
                        <div class="card ">
                        <input type="hidden" name="DSI[]" value="{{$pimage->svalue}}">
                        <img src="{{asset('images/homeslider/'.$pimage->svalue)}}" class="card-img-top" alt="...">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                        </div>
                      </div>
                      </div>
                    @endforeach
                  @endif
                  <div class="col-sm-6 col-md-3 imageitem unsortable" >
                    <div class="card addimage " data-type="DSI">
                    <img src="{{asset('/')}}images/product/productDefault.png" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                      <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                     
                    </div>
                  </div>
                  </div>
                  @if($errors->has('images'))
                <div class="text-danger">{{ $errors->first('images') }}</div>
                @endif
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile Slider Images <br><small style="font-size:11px;"> dimension(1000x500)</small></label>
              <div class="col-sm-10">               
                <div class="row " id="mobileimagesortable">
                  @if(isset($mobileImages) && $mobileImages->isNotEmpty())
                    @foreach($mobileImages as $pimage)
                      <div class="col-sm-6 col-md-3">
                        <div class="card ">
                        <input type="hidden" name="MSI[]" value="{{$pimage->svalue}}">
                        <img src="{{asset('images/homeslider/'.$pimage->svalue)}}" class="card-img-top" alt="...">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                        </div>
                      </div>
                      </div>
                    @endforeach
                  @endif
                  <div class="col-sm-6 col-md-3 imageitem mobileimageunsortable" >
                    <div class="card addimage" data-type="MSI">
                    <img src="{{asset('/')}}images/product/productDefault.png" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                      <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                     
                    </div>
                  </div>
                  </div>
                  @if($errors->has('images'))
                <div class="text-danger">{{ $errors->first('images') }}</div>
                @endif
                </div>
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
<form id="imageform " class="d-none">
  <input type="file" name="media" id="productmedia">
</form>
<div id="upload-form-modal" class="modal fade" role="dialog" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                      <h5 class="modal-title">Add Slider</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-4">
                          <label for="slider-type">Select slider type</label>
                           <select class="form-control" name="slider-type" id="slider-type">
                             <option value="1">Image</option>
                             <option value="2">Youtube video</option>
                           </select>
                      </div>
                      <div class="image-type">
                        <div class="mb-4">
                            <label for="slider-type">Desktop Image</label>
                            <div class="d-image">
                             <button class="btn btn-primary add-s-image" data-type="d-image" type="button">Add Image</button>
                           </div>
                        </div>
                        <div class="mb-4">
                            <label for="slider-type">Mobile Image</label>
                             <div class="m-image">
                             <button class="btn btn-primary add-s-image" data-type="m-image" type="button">Add Image</button>
                           </div>
                        </div>
                      </div>
                      <div class="youtube-type d-none">
                        <div class="mb-4">
                            <label for="slider-type">Youtube link</label>
                             <input type="text" name="youtube-url" class="form-control">
                        </div>
                        
                      </div>
                      <div class="mb-4">
                        
                          <button type="submit" class="btn btn-primary">Save</button>
                       
                      </div>
                    </div>
                    
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var ctype;
    $('.add-s-image').click(function(){
      ctype = $(this).data('type');
      $('#productmedia').click();
    });

    $('.addimage').click(function(){
      $('#upload-form-modal').modal('show');
    });
    $('#slider-type').change(function(){
      var stype = $(this).val();
      if(stype == "1"){
        $('.image-type').removeClass('d-none');
        $('.youtube-type').addClass('d-none');
      }else{
        $('.image-type').addClass('d-none');
        $('.youtube-type').removeClass('d-none');
      }
    });

    $( "#imagesortable" ).sortable({
       cancel: ".unsortable,input,textarea"     
    });
    $( "#mobileimagesortable" ).sortable({
       cancel: ".mobileimageunsortable,input,textarea"     
    });
    
    
    $('body').on('click','.deleteimage',function(){
      $(this).closest('.col-md-3').remove();
    });
    $('#productmedia').change(function(){
      var file_data = $('#productmedia').prop('files')[0];
      var form_data = new FormData();
      form_data.append('FileInput', file_data);
      form_data.append('path', "images/homeslider");
      form_data.append('type', "homesliderImage");
      form_data.append('_token', "{{csrf_token()}}");
      $.ajax({
          url: "{{route('imageuploader.imagesupload')}}", // point to server-side controller method
          dataType: 'json', // what to expect back from the server
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function (response) {
            if(response.status){
              var cart=`<div class="row"><div class="col-sm-6 col-md-3">
                    <div class="card ">
                    <input type="hidden" name="`+ctype+`[]" value="`+response.filename+`">
                    <img src="`+response.url+`" class="card-img-top" alt="...">
                    <div class="card-body text-center ">
                      <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                     
                    </div>
                  </div>
                  </div></div>`;
                $('.'+ctype).html(cart);
            }
          },
          error: function (response) {
              $('#msg').html(response); // display error response from the server
          }
      });
    });
  });
   
</script>

<script type="text/javascript" src="{{asset('/')}}assets/js/fileuploader.js"></script> 

@endsection

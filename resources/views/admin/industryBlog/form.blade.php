@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
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
    #bannerimagepreview{
      width: 200px;
    }
  </style>
@endsection

@section('content')
<div class="pagetitle">
      <h1>Blog</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Industry Blog</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('industryBlog.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">Industry Blog</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title</label>
                  <div class="col-md-10">
                    @if(!empty($IndustryBlog->id))
                   <input type="hidden" name="id" value="{{$IndustryBlog->id}}">
                   @endif
                   <input type="text" name="title" class="form-control" value="{{isset($IndustryBlog->title) ? $IndustryBlog->title : ''  }}">
                   @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Industry</label>
                  <div class="col-md-10">                   
                   {{-- <input type="text" name="industry_id" class="form-control" value="{{isset($IndustryBlog->industry_id) ? $IndustryBlog->industry_id : ''  }}"> --}}
                   <select class="form-select" name="industry_id">
                        <option disabled>Select One...</option>
                        @foreach ($industries as $key => $value)
                            <option value="{{$value->id}}"
                                @if(!empty($IndustryBlog->industry_id))
                                    {{  ($IndustryBlog->industry_id == $value->id) ? 'selected="selected"' : '' }}
                                @endif
                            />{{$value->title}}</option>
                        @endforeach
                  </select>
                   @if($errors->has('industry_id'))
                  <div class="text-danger">{{ $errors->first('industry_id') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">description</label>
                    <div class="col-md-10">
                      <textarea name="description"  id="description" class="content">{{isset($IndustryBlog->description) ? $IndustryBlog->description : ''  }}</textarea>
                      @if($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                    </div>                 
                  </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Image <br> <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                  <div class="col-sm-10">
                    <div class="card ">
                       
                        <img src="{{asset(isset($IndustryBlog->image) ? 'images/'.$IndustryBlog->image : 'images/computerbanner.jpg')}}" class="banner-img" alt="..." id="bannerimagepreview">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                        </div>
                      </div>
                      @if($errors->has('bannerimage'))
                        <div class="text-danger">{{ str_replace("bannerimage","banner image",$errors->first('bannerimage')) }}</div>
                    @endif
                    <div class="msg"></div>
                  </div>

                </div>
                <input type="file" name="bannerimage"  id="bannerimage" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif">
                
                <div class="row">
                  <div class="col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                </div>
              </form>
            </div>
          </div>

        </div>

       
      </div>
    </section>
<form id="imageform " class="d-none">
  <input type="file" name="media" id="productmedia" accept="image/png, image/jpeg, image/jpg, image/gif">
</form>
@include('admin.shared.videopopup')
@endsection
@section('scripts')
<script src="{{asset('/')}}assets/vendor/tinymce/tinymce.min.js"></script>  
<!-- <script src="{{asset('/')}}assets/vendor/quill/quill.min.js"></script>
<script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
  var editorsHight = 500;
  var editorimageuploadurl = "{{route('imageuploader.imagesupload')}}";  
  var csrftoken = "{{csrf_token()}}"; 

  $(document).ready(function() {    
    $('.addimage').click(function(){
      $('#productmedia').click();
    });
    $( "#imagesortable" ).sortable({
       cancel: ".unsortable,input,textarea"     
    });
    
    $( "#videoSortable" ).sortable({
       cancel: ".videounsortable,input,textarea"     
    });
    

    $('body').on('click','.deleteimage',function(){
      $(this).closest('.col-md-3').remove();
    });

    
    $('#productmedia').change(function(){
      var file_data = $('#productmedia').prop('files')[0];
      var form_data = new FormData();
      form_data.append('FileInput', file_data);
      form_data.append('path', "assets/img/industry");
      form_data.append('type', "productimage");
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
              var cart=`<div class="col-md-3">
                    <div class="card ">
                    <input type="hidden" name="images[]" value="`+response.filename+`">
                    <img src="`+response.url+`" class="card-img-top" alt="...">
                    <div class="card-body text-center ">
                      <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                     
                    </div>
                  </div>
                  </div>`;
                $('.imageitem').before(cart);
                $('#imagesortable').next('.text-danger').remove();
            }
          },
          error: function (response) {
              if(response.status==422 && typeof(response.responseJSON.errors) != "undefined" && typeof(response.responseJSON.errors.FileInput) != "undefined"){
                $('#imagesortable').after('<div class="text-danger">'+response.responseJSON.errors.FileInput.toString()+'</div>');                
              }else{
                $('#imagesortable').after('<div class="text-danger">'+response.responseJSON.message+'</div>');
              }
          }
      });
    });

    $('#addbannerimage').click(function(){
      $('#bannerimage').click();
    });
    $('#bannerimage').change(function(){
        const file = this.files[0];
        var sizeKB = file.size / 1024;
        if(sizeKB > 2048){
          $('.msg').html('<div class="text-danger">The banner image may not be greater than 2048 kilobytes</div>');
          return;
        }else if (!file.name.match(/\.(jpg|jpeg|png|gif|svg)$/) ){
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
<script type="text/javascript" src="{{asset('/')}}assets/js/editors.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/js/addvideo.js"></script>
@endsection
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
  </style>
@endsection

@section('content')
<div class="pagetitle">
      <h1>Case Study</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Case Study</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')
              
              <form method="POST" action="{{route('casestudy.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">Case Study</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title</label>
                  <div class="col-md-10">
                    @if(!empty($casestudy->id))
                   <input type="hidden" name="id" value="{{$casestudy->id}}">
                   @endif
                   <input type="text" name="title" class="form-control" value="{{old('title',isset($casestudy->title) ? $casestudy->title : '')  }}" placeholder="Title" required>
                   @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Client name</label>
                  <div class="col-md-10">                    
                   <input type="text" name="client_name" class="form-control" value="{{old('client_name',isset($casestudy->client_name) ? $casestudy->client_name : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Project year</label>
                  <div class="col-md-10">                    
                   <input type="text" name="project_year" class="form-control" value="{{old('project_year',isset($casestudy->project_year) ? $casestudy->project_year : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Project type</label>
                  <div class="col-md-10">                    
                   <input type="text" name="project_type" class="form-control" value="{{old('project_type',isset($casestudy->project_type) ? $casestudy->project_type : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title',isset($casestudy->meta_title) ? $casestudy->meta_title : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_keywords" class="form-control" value="{{old('meta_keywords',isset($casestudy->meta_keywords) ? $casestudy->meta_keywords : '')  }}">
                 </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                  <div class="col-md-10"> 
                  <textarea name="meta_description" class="form-control">{{old('meta_description',isset($casestudy->meta_description) ? $casestudy->meta_description : '')  }}</textarea>                   
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Short Description</label>
                  <div class="col-sm-10">
                    <textarea name="short_description" class="form-control {{$errors->has('short_description') ? 'border-danger' : '' }} " id="">{{old('short_description',isset($casestudy->short_description) ? $casestudy->short_description : '' )}}</textarea>
                    @if($errors->has('short_description'))
                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
                    @endif
                  </div>
                </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">Content</label>
                    <div class="col-md-10">
                      <textarea name="content"  id="content" class="content">{{old('content',isset($casestudy->content) ? $casestudy->content : '' ) }}</textarea>
                        @if($errors->has('content'))
                      <div class="text-danger">{{ $errors->first('content') }}</div>
                      @endif
                    </div>                 
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image <br> <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                    <div class="col-sm-10">
                      <div class="card ">
                          <img src="{{asset(isset($casestudy->image) ? 'images/'.$casestudy->image : 'images/computerbanner.jpg')}}" class="banner-img" alt="..." id="bannerimagepreview">
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
                  
                  {{-- <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Type</label>
                  <div class="col-md-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="pdf" value="pdf" @if(old('type',!empty($casestudy->filename) ? 'pdf' : 'video') == 'pdf')checked="" @endif>
                      <label class="form-check-label" for="pdf">
                        Pdf
                      </label>
                    </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="type" id="youTubeVideo" value="video" @if(old('type',!empty($casestudy->filename) ? 'pdf' : 'video') == 'video')checked="" @endif >
                      <label class="form-check-label" for="youTubeVideo">
                        Youtube Video
                      </label>
                    </div>
                   
                  </div>
                </div>
                <div class="row mb-3 {{old('type',!empty($casestudy->filename) ? 'pdf' : 'video') == 'video' ? 'd-none' : ''}}" id="file-con">
                  <label for="inputText" class="col-md-2 col-form-label">File</label>
                  <div class="col-md-10">
                    
                   <input type="file" name="filename" class="form-control" value="" accept=".pdf">
                   @if($errors->has('filename'))
                  <div class="text-danger">{{ $errors->first('filename') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3 {{old('type',!empty($casestudy->filename) ? 'pdf' : 'video') == 'video' ? '' : 'd-none'}}" id="video-con">
                  <label for="inputText" class="col-md-2 col-form-label">Video Url</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="videourl" class="form-control" value="{{old('videourl',!empty($casestudy->video) ? $casestudy->video : '')}}" placeholder="Youtube video url">
                   @if($errors->has('videourl'))
                  <div class="text-danger">{{ $errors->first('videourl') }}</div>
                  @endif
                  </div>
                </div> --}}
               
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

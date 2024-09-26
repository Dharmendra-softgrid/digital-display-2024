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
      <h1>Video</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Video</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('videoLink.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">Video Link</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title</label>
                  <div class="col-md-10">
                    @if(!empty($VideoLink->id))
                   <input type="hidden" name="id" value="{{$VideoLink->id}}">
                   @endif
                   <input type="text" name="title" class="form-control" value="{{isset($VideoLink->title) ? $VideoLink->title : ''  }}">
                   @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Page</label>
                  <div class="col-md-10">                   
                   <input type="text" name="type" class="form-control" value="{{isset($VideoLink->type) ? $VideoLink->type : ''  }}">
                   @if($errors->has('type'))
                  <div class="text-danger">{{ $errors->first('type') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Link</label>
                  <div class="col-md-10">                   
                   <textarea name="link" class="form-control {{$errors->has('link') ? 'border-danger' : '' }} " id="">{{old('link',isset($VideoLink->link) ? $VideoLink->link : '' )}}</textarea>
                   @if($errors->has('link'))
                  <div class="text-danger">{{ $errors->first('link') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Short Description</label>
                    <div class="col-sm-10">
                      <textarea name="short_description" class="form-control {{$errors->has('short_description') ? 'border-danger' : '' }} " id="">{{old('short_description',isset($VideoLink->short_description) ? $VideoLink->short_description : '' )}}</textarea>
                      @if($errors->has('short_description'))
                      <div class="text-danger">{{ $errors->first('short_description') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">Display Order</label>
                    <div class="col-md-10">                   
                     <input type="number" name="sort_order" class="form-control" value="{{isset($VideoLink->sort_order) ? $VideoLink->sort_order : ''  }}">
                     @if($errors->has('sort_order'))
                    <div class="text-danger">{{ $errors->first('sort_order') }}</div>
                    @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Thumbnail</label>
                    <div class="col-sm-4">
                      <div class="card ">
                          <img src="{{asset(isset($VideoLink->thumbnail) ? 'images/'.$VideoLink->thumbnail : 'images/inds1.jpg')}}" class="card-img-top" alt="..." id="bannerimagepreview">
                          <div class="card-body text-center ">
                            <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                          </div>
                        </div>
                        @if($errors->has('bannerimage'))
                          <div class="text-danger">{{ $errors->first('bannerimage') }}</div>
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
          $('.msg').html('<div class="text-danger">file size should less then 2MB.</div>');
          return;
        }else if (!file.name.match(/\.(jpg|jpeg|png|gif)$/) ){
          $('.msg').html('<div class="text-danger">this is not an image.</div>');
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
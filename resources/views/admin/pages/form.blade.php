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
<div class="pagetitle">
      <h1>Pages</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Pages</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('page.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">{{isset($page->title) ? $page->title : 'New Page'  }}</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-md-10">
                    @if(!empty($page->id))
                   <input type="hidden" name="id" value="{{$page->id}}">
                   @endif
                   <input type="text" name="title" class="form-control" value="{{old('title',isset($page->title) ? $page->title : '')  }}">
                    @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title',isset($page->meta_title) ? $page->meta_title : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_keywords" class="form-control" value="{{old('meta_keywords',isset($page->meta_keywords) ? $page->meta_keywords : '')  }}">
                 </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                  <div class="col-md-10"> 
                  <textarea name="meta_description" class="form-control">{{old('meta_description',isset($page->meta_description) ? $page->meta_description : '')  }}</textarea>                   
                  
                 </div>
                </div>
                {{-- <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Content</label>
                  <div class="col-md-10">
                    <textarea name="content"  id="content" class="content">{{old('content',isset($page->content) ? $page->content : '')  }}</textarea>
                     @if($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                    @endif
                  </div>                 
                </div> --}}
                {{-- <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Banner Image <br> <small style="font-size;11px;">(1920x640)</small></label>
                  <div class="col-sm-10">
                    <div class="card ">
                       
                        <img src="{{asset(isset($page->banner_image) ? 'images/'.$page->banner_image : 'images/computerbanner.jpg')}}" class="card-img-top" alt="..." id="bannerimagepreview">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                        </div>
                      </div>
                      @if($errors->has('bannerimage'))
                        <div class="text-danger">{{str_replace("bannerimage","banner image",$errors->first('bannerimage')) }}</div>
                    @endif
                    <div class="msg"></div>
                  </div>

                </div> --}}
                {{-- <input type="file" name="bannerimage" id="bannerimage" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif"> --}}
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


@endsection
@section('scripts')
<script src="{{asset('/')}}assets/vendor/tinymce/tinymce.min.js"></script>  
<!-- <script src="{{asset('/')}}assets/vendor/quill/quill.min.js"></script>
<script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
<script type="text/javascript">
  var editorsHight = 300;  
  var editorimageuploadurl = "{{route('imageuploader.imagesupload')}}";  
  var csrftoken = $('input[name=_token]').val();  
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
            
            $('#bannerimagepreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
  });
</script>
<script type="text/javascript" src="{{asset('/')}}assets/js/editors.js"></script>
@endsection
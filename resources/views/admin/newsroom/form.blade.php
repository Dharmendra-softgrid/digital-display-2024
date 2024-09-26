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
        </ol>
      </nav>
    </div><!-- End newsroom Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('newsroom.store')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}<br>
              {{-- <h5 class="card-title">{{isset($newsroom->title) ? $newsroom->title : 'New Newsroom'  }}</h5> --}}
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title</label>
                  <div class="col-md-10">
                    @if(!empty($newsroom->id))
                   <input type="hidden" name="id" value="{{$newsroom->id}}">
                   @endif
                   <input type="text" name="title" class="form-control" value="{{old('title',isset($newsroom->title) ? $newsroom->title : '')  }}">
                    @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title',isset($newsroom->meta_title) ? $newsroom->meta_title : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_keywords" class="form-control" value="{{old('meta_keywords',isset($newsroom->meta_keywords) ? $newsroom->meta_keywords : '')  }}">
                 </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                  <div class="col-md-10"> 
                  <textarea name="meta_description" class="form-control">{{old('meta_description',isset($newsroom->meta_description) ? $newsroom->meta_description : '')  }}</textarea>                   
                  
                 </div>
                </div>
                <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Short Description</label>
              <div class="col-sm-10">
                <textarea name="short_description" class="form-control {{$errors->has('short_description') ? 'border-danger' : '' }} " id="">{{old('short_description',isset($newsroom->short_description) ? $newsroom->short_description : '' )}}</textarea>
                @if($errors->has('short_description'))
                <div class="text-danger">{{ $errors->first('short_description') }}</div>
                @endif
              </div>
            </div>
              <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Publisher</label>
                  <div class="col-md-10">                    
                   <input type="text" name="publisher" class="form-control" value="{{old('publisher',isset($newsroom->publisher) ? $newsroom->publisher : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Content</label>
                  <div class="col-md-10">
                    <textarea name="content"  id="content" class="content">{{old('content',isset($newsroom->content) ? $newsroom->content : '' ) }}</textarea>
                     @if($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                    @endif
                  </div>                 
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Link</label>
                  <div class="col-md-10">                    
                   <input type="text" name="link" class="form-control" value="{{old('link',isset($newsroom->link) ? $newsroom->link : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Image <br> <small style="font-size;11px;">(600x446)</small></label>
                  <div class="col-sm-4">
                    <div class="card ">
                       
                        <img src="{{asset(isset($newsroom->image) ? 'images/'.$newsroom->image : 'images/inds1.jpg')}}" class="card-img-top" alt="..." id="bannerimagepreview">
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
                <input type="file" name="image" accept="image" id="bannerimage" class="d-none">
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
@endsection
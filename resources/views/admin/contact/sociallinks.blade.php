@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
 
@endsection

@section('content')
<div class="pagetitle">
      <h1>Social Links</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Social Links</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('contact.storeSocialLinks')}}"> 
                {{ csrf_field() }}
              <h5 class="card-title">Settings</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">facebook</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="facebook" class="form-control" value="{{$facebook ?? ''}}">
                   @if($errors->has('facebook'))
                        <div class="text-danger">{{ $errors->first('facebook') }}</div>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">instagram</label>
                  <div class="col-md-10">
                    @if(!empty($page->id))
                   <input type="hidden" name="id" value="{{$page->id}}">
                   @endif
                   <input type="text" name="instagram" class="form-control" value="{{$instagram ?? ''}}">
                   @if($errors->has('instagram'))
                        <div class="text-danger">{{ $errors->first('instagram') }}</div>
                    @endif
                  </div>
                  
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">linkedin</label>
                    <div class="col-md-10">
                      @if(!empty($page->id))
                     <input type="hidden" name="id" value="{{$page->id}}">
                     @endif
                     <input type="text" name="linkedin" class="form-control" value="{{$linkedin ?? ''}}">
                     @if($errors->has('linkedin'))
                          <div class="text-danger">{{ $errors->first('linkedin') }}</div>
                      @endif
                    </div>
                    
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">twitter</label>
                    <div class="col-md-10">
                      @if(!empty($page->id))
                     <input type="hidden" name="id" value="{{$page->id}}">
                     @endif
                     <input type="text" name="twitter" class="form-control" value="{{$twitter ?? ''}}">
                     @if($errors->has('twitter'))
                          <div class="text-danger">{{ $errors->first('twitter') }}</div>
                      @endif
                    </div>
                    
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-md-2 col-form-label">youtube</label>
                    <div class="col-md-10">
                      @if(!empty($page->id))
                     <input type="hidden" name="id" value="{{$page->id}}">
                     @endif
                     <input type="text" name="youtube" class="form-control" value="{{$youtube ?? ''}}">
                     @if($errors->has('youtube'))
                          <div class="text-danger">{{ $errors->first('youtube') }}</div>
                      @endif
                    </div>
                    
                  </div>
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
<script type="text/javascript">
  var editorsHight = 500;
  var editorimageuploadurl = "{{route('imageuploader.imagesupload')}}";  
  var csrftoken = "{{csrf_token()}}"; 
</script>
<script src="{{asset('/')}}assets/vendor/tinymce/tinymce.min.js"></script> 
<script type="text/javascript" src="{{asset('/')}}assets/js/fileuploader.js"></script> 
<script type="text/javascript" src="{{asset('/')}}assets/js/editors.js"></script>
@endsection
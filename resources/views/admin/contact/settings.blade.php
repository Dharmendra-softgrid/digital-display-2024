@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
 
@endsection

@section('content')
<div class="pagetitle">
      <h1>Contact us</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Contact</li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('contact.store')}}"> 
                {{ csrf_field() }}
              <h5 class="card-title">Settings</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Email</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="email" class="form-control" value="{{$email ?? ''}}">
                   @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Phone</label>
                  <div class="col-md-10">
                    @if(!empty($page->id))
                   <input type="hidden" name="id" value="{{$page->id}}">
                   @endif
                   <input type="text" name="mobile" class="form-control" value="{{$mobile ?? ''}}">
                   @if($errors->has('mobile'))
                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                    @endif
                  </div>
                  
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Address</label>
                  <div class="col-md-10">
                    <textarea name="address"  id="content" class="form-control">{{$address ?? ''}}</textarea>
                    @if($errors->has('address'))
                        <div class="text-danger">{{ $errors->first('address') }}</div>
                    @endif 
                  </div> 
                                 
                </div>
                {{-- <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Page Description</label>
                  <div class="col-md-10">
                    <textarea name="desc"  id="desc" class="form-control content">{{$description ?? ''}}</textarea>
                    @if($errors->has('desc'))
                        <div class="text-danger">{{ $errors->first('desc') }}</div>
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
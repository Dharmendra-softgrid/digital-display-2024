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
      <h1>Copyright</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Footer</li>
          <li class="breadcrumb-item active">Copyright</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('admin.footer.copyright.save')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">Copyright</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Content</label>
                  <div class="col-md-10">
                    <?php $content = ' <p>© 2022 Panasonic Corporation of Asia. All Rights Reserved</p>
                  <p>MRP wherever mentioned is inclusive of all taxes</p>

                  <p>For more information on e-waste or e-waste pick, please call 1800 103 1333 or 1800 105 1333 or click here</p>'; ?>
                    <textarea name="content" class="form-control content">{!!isset($copyright) ? $copyright->svalue : $content  !!}</textarea>
                    @if($errors->has('facebook'))
                  <div class="text-danger">{{ $errors->first('facebook') }}</div>
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
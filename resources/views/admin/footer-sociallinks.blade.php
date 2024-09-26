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
      <h1>Social links</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Footer</li>
          <li class="breadcrumb-item active">Social links</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

        
          

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('admin.footer.sociallinks.save')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
              <h5 class="card-title">Social Links</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Facebook</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="facebook" class="form-control" value="{{isset($facebook) ? $facebook->svalue : ''  }}">
                    @if($errors->has('facebook'))
                  <div class="text-danger">{{ $errors->first('facebook') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Instagram</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="instagram" class="form-control" value="{{isset($instagram) ? $instagram->svalue : ''  }}">
                    @if($errors->has('instagram'))
                  <div class="text-danger">{{ $errors->first('instagram') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Linkedin</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="linkedin" class="form-control" value="{{isset($linkedin) ? $linkedin->svalue : ''  }}">
                    @if($errors->has('linkedin'))
                  <div class="text-danger">{{ $errors->first('linkedin') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Twitter</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="twitter" class="form-control" value="{{isset($twitter) ? $twitter->svalue : ''  }}">
                    @if($errors->has('twitter'))
                  <div class="text-danger">{{ $errors->first('twitter') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Youtube</label>
                  <div class="col-md-10">
                    
                   <input type="text" name="youtube" class="form-control" value="{{isset($youtube) ? $youtube->svalue : ''  }}">
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
 
  $(document).ready(function(){
    
  });
</script>

@endsection
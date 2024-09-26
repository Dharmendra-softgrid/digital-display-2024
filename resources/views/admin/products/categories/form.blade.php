@extends('admin.layouts.app')
@section('styles')
<style type="text/css">
  .banner_img {
    width: 100%;
}
</style>
@endsection

@section('content')
    <div class="pagetitle">
      <h1>{{!empty($category->id) ? 'Edit' : 'Create'}} Product Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('productCategory.index')}}">Product Category</a></li>
          <li class="breadcrumb-item active">{{!empty($category->id) ? 'Edit' : 'Create'}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <h5 class="card-title">Product category</h5>

              <!-- Horizontal Form -->
              <form method="POST" action="{{route('productCategory.store')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 @if(!empty($category->id))
                 <input type="hidden" name="id" value="{{$category->id}}">
                 @endif
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="title" class="form-control {{$errors->has('title') ? 'border-danger' : '' }} " id="inputText" value="{{old('title',isset($category->title) ? $category->title : '' )}}">
                    @if($errors->has('title'))
                        <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                  </div>

                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_title" class="form-control" value="{{old('meta_title',isset($category->meta_title) ? $category->meta_title : '')  }}">                    
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                  <div class="col-md-10">                    
                   <input type="text" name="meta_keywords" class="form-control" value="{{old('meta_keywords',isset($category->meta_keywords) ? $category->meta_keywords : '')  }}">
                 </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                  <div class="col-md-10"> 
                  <textarea name="meta_description" class="form-control">{{old('meta_description',isset($category->meta_description) ? $category->meta_description : '')  }}</textarea>                   
                  
                 </div>
                </div>
                {{-- <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea name="description" id="content" class="form-control {{$errors->has('description') ? 'border-danger' : '' }} content">
                      @if(old('desscription'))
                      {{old('desscription')}}
                      @elseif(isset($category->description))
                      {{$category->description}}
                      @else
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="wow fadeInDown">
                              <div class="ser_block_desc">
                                <h4 class="head_common text-center mb-lg-5">Purpose-built and rugged for your extraordinary work.</h4>
                                <p>Your work is extraordinary, and your devices need to match you step for step. That’s why we build rugged laptops and 2-in-1's that are trusted by hardworking people in the toughest environments anywhere.</p>
                                <p>At Panasonic Connect, we face our customers’ challenges alongside them so that we can provide the right rugged tools that revolutionize how work gets done. Our forward-looking solutions help you meet evolving industry demands and empower your workforce.</p>
                               </div>
                           </div>
                        </div>
                     </div>
                      @endif
                    </textarea>
                    @if($errors->has('description'))
                        <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                  </div>
                </div> --}}
                {{-- <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Banner Image <br> <small style="font-size;11px;">(1920x640)</small></label>
                  <div class="col-sm-10">
                    <div class="card ">
                       
                        <img src="{{asset(!empty($category->banner_image) ? 'images/'.$category->banner_image : 'images/computerbanner.jpg')}}" class="card-img-top" alt="..." id="bannerimagepreview">
                        <div class="card-body text-center ">
                          <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                        </div>
                      </div>
                      @if($errors->has('bannerimage'))
                        <div class="text-danger">{{ str_replace("bannerimage","banner image",$errors->first('bannerimage'))  }}</div>
                    @endif
                    <div class="msg"></div>
                  </div>

                </div>
                <input type="file" name="bannerimage"  id="bannerimage" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif">
                --}}
                
                
                <div class="row">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form><!-- End Horizontal Form -->

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
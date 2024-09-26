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
      <h1>{{!empty($variant->id) ? 'Edit' : 'Create'}} Product Variant</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('productVariantList.index')}}">Product Variant</a></li>
          <li class="breadcrumb-item active">{{!empty($variant->id) ? 'Edit' : 'Create'}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <h5 class="card-title">Product variant</h5>

              <!-- Horizontal Form -->
              <form method="POST" action="{{route('productVariantList.store')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 @if(!empty($variant->id))
                 <input type="hidden" name="id" value="{{$variant->id}}">
                 @endif
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control {{$errors->has('name') ? 'border-danger' : '' }} " id="inputText" value="{{old('name',isset($variant->name) ? $variant->name : '' )}}">
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                </div>
                
                
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
<script type="text/javascript" src="{{asset('/')}}assets/js/editors.js"></script>
@endsection
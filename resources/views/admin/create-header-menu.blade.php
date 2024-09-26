@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <style type="text/css">
    .tox-promotion,.tox-statusbar__branding{
      display: none;
    }
     .indent {
        margin-left: 20px;
        margin-right: 20px;
    }
  </style>
@endsection

@section('content')
<div class="pagetitle">
      <h1>{{!empty($smenu->menu_type) && $smenu->menu_type=='footer' ? 'Footer' : 'Header' }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">{{!empty($smenu->menu_type) && $smenu->menu_type=='footer' ? 'Footer' : 'Header' }}</li>
          <li class="breadcrumb-item active">Menu</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('admin.header.menu.save')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                <input type="hidden" name="menu_type" value="{{!empty($smenu->menu_type) ? $smenu->menu_type : 'header' }}">
                @if(!empty($smenu->id))
                <input type="hidden" name="id" value="{{$smenu->id}}">
                @endif
              <h5 class="card-title">Menu</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-md-10">
                    <input type="text" name="title" class="form-control" value="{{old('title',(!empty($smenu->title) ? $smenu->title : ''))}}" >                  
                    
                    @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Menu Type <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-md-10">
                     <select name="type" id="types" class="form-control">
                       <option value="">--- Select ---</option>
                       <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="custom" {{( $c == 'custom' ? 'Selected' : 'false')}} >Custom</option> 
                       @if(isset($pages) && $pages->isNotEmpty())
                      <optgroup label="Pages">
                       @foreach($pages as $item)
                       <?php $p=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="page.{{$item->slug}}" {{($p == 'page.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($categories) && $categories->isNotEmpty())
                       <optgroup label="Categories">
                       @foreach($categories as $item)
                       <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="category.{{$item->slug}}" {{($c == 'category.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($products) && $products->isNotEmpty())
                       <optgroup label="Products">
                       @foreach($products as $item)
                        <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="product.{{$item->slug}}" {{($c == 'product.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                     @endif
                     @if(isset($industries) && $industries->isNotEmpty())
                       <optgroup label="Industries">
                       @foreach($industries as $item)
                       <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="industries.{{$item->slug}}" {{($c == 'industries.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($newsrooms) && $newsrooms->isNotEmpty())
                       <optgroup label="Newsrooms">
                        <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                        <option value="newsroom.list" {{($c == 'newsroom.list' ? 'selected' : '')}}>Newsroom list</option>
                       @foreach($newsrooms as $item)
                       <?php $c=old('type',!empty($smenu->type) ? $smenu->type : ''); ?>
                       <option value="newsroom.{{$item->slug}}" {{($c == 'newsroom.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                     </select>              
                    
                    @if($errors->has('type'))
                  <div class="text-danger">{{ $errors->first('type') }}</div>
                  @endif
                  </div>
                </div>
                <?php 
                  $disply = '';
                  if(old('type') == 'custom'){
                    $disply = 'display:flex;';
                  }else if(isset($smenu->type) && $smenu->type!='custom'){
                    $disply = 'display:none;';
                  }
                 ?>
                <div class="row mb-3 " id="links-wrapper" style="{{$disply}}">
                  <label for="inputText" class="col-md-2 col-form-label">Link</label>
                  <div class="col-md-10">
                    <input type="text" name="link" class="form-control" value="{{old('link',(!empty($smenu->link) ? $smenu->link : ''))}}">
                    @if($errors->has('link'))
                  <div class="text-danger">{{ $errors->first('link') }}</div>
                  @endif
                  </div>

                </div>
                 @if(!isset($smenu->menu_type) || (isset($smenu->menu_type) && $smenu->menu_type=='header'))
                <div class="row mb-3 " >
                  <label for="inputText" class="col-md-2 col-form-label">Parent Menu</label>
                  <div class="col-md-10">
                    <select name="parent" class="form-control">
                      <option value="0">Select Parent menu</option>
                      @if(isset($menus) && $menus->isNotEmpty())
                      @foreach($menus as $item)
                       <option value="{{$item->id}}" {{(old('parent',!empty($smenu->parent) ? $smenu->parent : '') == $item->id ? 'selected' : '')}}>{{$item->title}} </option>
                       @if($item->children->isNotEmpty())
                          @foreach($item->children as $i=>$n)
                            <option value="{{$n->id}}" {{(old('parent',!empty($smenu->parent) ? $smenu->parent : '') == $n->id ? 'selected' : '')}}>
                              &nbsp; &nbsp; &nbsp; {{$n->title}}</option>
                              @if($n->children->isNotEmpty())
                                 @foreach($n->children as $i=>$nc)
                                    <option value="{{$n->id}}" {{(!empty($smenu->parent) &&  $smenu->parent == $nc->id ? 'selected' : '')}}>
                                      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$nc->title}}</option>
                                  @endforeach
                              @endif
                          @endforeach
                        @endif
                        @endforeach
                      @endif

                    </select>
                  </div>
                </div>
                @endif
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Sort Order <span style="color: red; font-size: small;">*</span></label>
                  <div class="col-md-10">
                    <input type="number" name="sort_order" class="form-control" value="{{old('sort_order',(!empty($smenu->sort_order) ? $smenu->sort_order : ''))}}" >                  
                    
                    @if($errors->has('sort_order'))
                  <div class="text-danger">{{ $errors->first('sort_order') }}</div>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#types').select2();

    $('#types').on('change',function(){
      if($(this).val() == 'custom'){
        
        $('#links-wrapper').show();
      }else{
        $('#links-wrapper').hide();
      }
    });  

    });
  
</script>
@endsection

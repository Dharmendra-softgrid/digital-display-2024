@extends('admin.layouts.app')

@section('styles')
<style type="text/css">
  .indent {
    margin-left: 20px;
    margin-right: 20px;
}
</style>
@endsection
@section('content')
<div class="pagetitle">
      <h1>Menu</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Footer</li>
          <li class="breadcrumb-item active">Menu</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section ">

<div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            <!-- Recent Sales -->
            <div class="col-12">
               <div class="card">
            <div class="card-body">
              @include('admin.shared.displaymsg')

              <form method="POST" action="{{route('admin.footer.menu.save')}}" enctype="multipart/form-data"> 
                {{ csrf_field() }}
                <input type="hidden" name="menu_type" value="footer">
                @if(!empty($smenu->id))
                <input type="hidden" name="id" value="{{$smenu->id}}">
                @endif
              <h5 class="card-title">Add Menu</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Title</label>
                  <div class="col-md-10">
                    <input type="text" name="title" class="form-control" value="{{old('title',(!empty($smenu->title) ? $smenu->title : ''))}}" >                  
                    
                    @if($errors->has('title'))
                  <div class="text-danger">{{ $errors->first('title') }}</div>
                  @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-md-2 col-form-label">Menu Type</label>
                  <div class="col-md-10">
                     <select name="type" id="types" class="form-control">
                       <option value="">--- Select ---</option>
                       <option value="custom" {{(!empty($smenu->type) &&  $smenu->type == 'custom' ? 'Selected' : 'false')}} >Custom</option> 
                       @if(isset($pages) && $pages->isNotEmpty())
                      <optgroup label="Pages">
                       @foreach($pages as $item)
                       <option value="page.{{$item->slug}}" {{(!empty($smenu->type) &&  $smenu->type == 'page.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($categories) && $categories->isNotEmpty())
                       <optgroup label="Categories">
                       @foreach($categories as $item)
                       <option value="category.{{$item->slug}}" {{(!empty($smenu->type) &&  $smenu->type == 'category.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($products) && $products->isNotEmpty())
                       <optgroup label="Products">
                       @foreach($products as $item)
                       <option value="product.{{$item->slug}}" {{(!empty($smenu->type) &&  $smenu->type == 'product.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                     @endif
                     @if(isset($industries) && $industries->isNotEmpty())
                       <optgroup label="Industries">
                       @foreach($industries as $item)
                       <option value="industries.{{$item->slug}}" {{(!empty($smenu->type) &&  $smenu->type == 'industries.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                       @if(isset($newsrooms) && $newsrooms->isNotEmpty())
                       <optgroup label="Newsrooms">
                        <option value="newsroom.list" {{(!empty($smenu->type) &&  $smenu->type == 'newsroom.list' ? 'selected' : '')}}>Newsroom list</option>
                       @foreach($newsrooms as $item)
                       <option value="newsroom.{{$item->slug}}" {{(!empty($smenu->type) &&  $smenu->type == 'newsroom.'.$item->slug ? 'selected' : '')}}>{{$item->title}}</option>
                       @endforeach
                     </optgroup>
                       @endif
                     </select>              
                    
                    @if($errors->has('facebook'))
                  <div class="text-danger">{{ $errors->first('facebook') }}</div>
                  @endif
                  </div>
                </div>
                <div class="row mb-3 " id="links-wrapper" style="display: none;">
                  <label for="inputText" class="col-md-2 col-form-label">Link</label>
                  <div class="col-md-10">
                    <input type="text" name="link" class="form-control" value="{{old('link',(!empty($smenu->link) ? $smenu->link : ''))}}">                  
                    
                    @if($errors->has('link'))
                  <div class="text-danger">{{ $errors->first('link') }}</div>
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
              <div class="card">
            <div class="card-body">
                <div class="justify-content-between mt-4">
                  
                  <h5 class="card-title ">Menu List</h5>
                  
              
                </div>
              
              <table class="table table-bordered">
                <thead>
                  <tr>                    
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($menus->isNotEmpty())
                    @foreach($menus as $i=>$nr)
                      <tr>
                        
                        <td>{{$nr->title}}</td>                        
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$nr->id}}"><i class="bi bi-trash"></i></button>

                          <a title="edit" href="{{route('admin.header.menu.edit',['id'=>$nr->id])}}" class="btn btn-primary btn-sm " data-id="{{$nr->id}}"><i class="bi bi-pencil"></i></a>
                          
                        </td>
                      </tr>
                      @if($nr->children->isNotEmpty())
          
                      @foreach($nr->children as $i=>$n)
                        <tr>
                        
                        <td><span class="indent"></span>{{$n->title}}</td>                        
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$n->id}}"><i class="bi bi-trash"></i></button>

                          <!-- <a title="edit" href="{{route('admin.header.menu.edit',['id'=>$n->id])}}" class="btn btn-primary btn-sm " data-id="{{$n->id}}"><i class="bi bi-pencil"></i></a> -->
                          
                        </td>
                      </tr>
                      @endforeach
                    
                    @endif
                    @endforeach
                  @else
                    <tr>
                      <td colspan="4" class="text-center">No record found</td>
                    </tr>
                  @endif

                </tbody>
              </table>
              

            </div>
          </div>
            </div><!-- End Recent Sales -->

            

          </div>
        </div><!-- End Left side columns -->

       

      </div>
      <form method="POST" action="" id="Deletefrom">
            @method('DELETE')
            @csrf
      </form>
      <div class="modal fade" id="deletecat" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Are you Sure?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     Are you sure you want to delete page?.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="button" class="btn btn-primary" id="yesdelete">Yes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
</section>
@endsection
@section('scripts')
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script type="text/javascript">
  var delid;
  var delurl="{{url('admin/headermenu/delete')}}";
  $(document).ready(function(){
    $('.deletebtn').click(function(){
      delid = $(this).data('id');
      $('#deletecat').modal('show');
    });
    $('#yesdelete').click(function(){
      $('#Deletefrom').attr('action',delurl+'/'+delid);
      $('#Deletefrom').submit();
    });
  });

   
</script>
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
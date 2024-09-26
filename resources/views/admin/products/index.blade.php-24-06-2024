@extends('admin.layouts.app')
@section('styles')
<style type="text/css">
  .image-holder{
    width: 80px;
  }
  .product_img{
    width: 100%;
    height: 80px;
    object-fit: cover;
  }
</style>
@endsection

@section('content')
<div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Products</li>
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
                <div class="d-flex justify-content-between mt-4">
                  
                  <h5 class="card-title ">Products</h5>
                  <div>
                  <a href="{{route('product.create')}}" class="btn btn-primary"><i class="bi bi-plus"></i> Add product</a>
                  </div>
              
                </div>
                
                
              <div class="table-responsive">
              <table class="table table-bordered ">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>                    
                    <!-- <th scope="col">Category</th>                    
                    <th scope="col">Industry</th>                     -->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($products->isNotEmpty())
                    @foreach($products as $i=>$pc)
                      <tr>
                        <?php $pimage= "productDefault.png";
                          if(!empty($pc->featured_image)){
                            $pimage = $pc->featured_image;
                          }
                         ?>
                        <td>
                          <div class="image-holder">
                            <img src="{{asset('images/'.$pimage)}}" class="product_img">
                          </div>
                          
                        </td>
                        <td >{{$pc->title}}</td>
                        <!-- <td >{{count($pc->product_categories) > 0 ? $pc->product_categories->implode('title', ',') : '' }}</td>
                        <td >{{count($pc->industries) > 0 ? $pc->industries->implode('title', ',') : '' }}</td> -->
                        
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$pc->id}}"><i class="bi bi-trash"></i></button>

                          <a title="edit" href="{{route('product.edit',['id'=>$pc->id])}}" class="btn btn-primary btn-sm " data-id="{{$pc->id}}"><i class="bi bi-pencil"></i></a>
                          
                        </td>
                      </tr>
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
                      <h5 class="modal-title">Are you sure ?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     Are you sure you want to delete product ?
                     <p>if you delete this product, all related data will be deleted.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="button" class="btn btn-danger" id="yesdelete">Yes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
</section>
@endsection
@section('scripts')
<script type="text/javascript">
  var delid;
  var delurl="{{url('admin/product')}}";
  $(document).ready(function(){
    $('.deletebtn').click(function(){
      delid = $(this).data('id');
      $('#deletecat').modal('show');
    });
    $('#yesdelete').click(function(){
      $('#cat_id').val(delid);
      $('#Deletefrom').attr('action',delurl+'/'+delid);
      $('#Deletefrom').submit();
    });
  });
</script>
@endsection
@extends('admin.layouts.app')


@section('styles')
<style type="text/css">
  .grid_banner_image{
    width: 80px;
    height: 80px;
  }
</style>
@endsection
@section('content')
<div class="pagetitle">
      <h1>Product Series</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Product Series</li>
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
                  
                  <h5 class="card-title ">Product Series</h5>
                  <div>
                  <a href="{{route('productSeries.create')}}" class="btn btn-primary  "><i class="bi bi-plus"></i> Add Series</a>
                  </div>
              
                </div>
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Series</th>    
                    <th scope="col">Category</th>                      
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($productSeries->isNotEmpty())
                    @foreach($productSeries as $i=>$pc)
                      <tr>
                        <th scope="row">{{$i+1}}</th>
                        <td> {{$pc->name}}</td>
                        @php
                         $category_name = \App\ProductCategory::where('id', $pc->category_id)->value('title');
                        @endphp
                        <td>{{$category_name}}</td>
                        
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$pc->id}}"><i class="bi bi-trash"></i></button>

                          <a title="edit" href="{{route('productSeries.edit',['id'=>$pc->id])}}" class="btn btn-primary btn-sm " data-id="{{$pc->id}}"><i class="bi bi-pencil"></i></a>
                          
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
                     Are you sure you want to delete category?
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
<script type="text/javascript">
  var delid;
  var delurl="{{url('admin/productSeries')}}";
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
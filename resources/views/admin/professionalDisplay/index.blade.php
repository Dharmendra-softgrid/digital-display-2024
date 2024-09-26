@extends('admin.layouts.app')

@section('content')
<style>
  img.slide-img {
    width: 200px;
  }
  .industry_img{
      width: 100%;
      height: 80px;
      object-fit: cover;
    }
  </style>
<div class="pagetitle">
      <h1>Display Solution</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Display Solution</li>
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
                  
                  <h5 class="card-title ">Professional Display Solutions</h5>
                  <div>
                  <a href="{{route('professionalDisplay.create')}}" class="btn btn-primary  "><i class="bi bi-plus"></i>Add</a>
                  </div>
              
                </div>
                
                
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Solution</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($profDisplay->isNotEmpty())
                    @foreach($profDisplay as $i=>$pds)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pds->title}}</td>  
                        <td>{{$pds->DisplaySolution->title}}</td>  
                        <?php $pimage= "productDefault.png";
                          if(!empty($pds->image)){
                            $pimage = $pds->image;
                          }
                         ?>
                        <td>
                          <div class="image-holder">
                            <img src="{{asset('images/'.$pimage)}}" class="industry_img">
                          </div>
                          
                        </td>                        
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$pds->id}}"><i class="bi bi-trash"></i></button>

                          <a title="edit" href="{{route('professionalDisplay.edit',['id'=>$pds->id])}}" class="btn btn-primary btn-sm " data-id="{{$pds->id}}"><i class="bi bi-pencil"></i></a>
                          
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
                      <h5 class="modal-title">Are you sure?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     Are you sure you want to delete display solution?
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
  var delurl="{{url('admin/professionalDisplay')}}";
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
@endsection
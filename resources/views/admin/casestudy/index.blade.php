@extends('admin.layouts.app')

@section('content')
<style>
  img.slide-img {
    width: 200px;
  }
  .casestudy_img{
      width: 100%;
      height: 80px;
      object-fit: cover;
    }
  </style>
<div class="pagetitle">
      <h1>Case Studies</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Case Studies</li>
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
                  
                  <h5 class="card-title ">Case Studies</h5>
                  <div>
                  <a href="{{route('casestudy.create')}}" class="btn btn-primary  "><i class="bi bi-plus"></i> Add Case Study</a>
                  </div>
              
                </div>
                
                
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($casestudies->isNotEmpty())
                    @foreach($casestudies as $i=>$cd)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$cd->title}}</td> 
                        <?php $pimage= "productDefault.png";
                          if(!empty($cd->image)){
                            $pimage = $cd->image;
                          }
                         ?>
                        <td>
                          <div class="image-holder">
                            <img src="{{asset('images/'.$pimage)}}" class="casestudy_img">
                          </div>
                        </td>                       
                        <td>
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$cd->id}}"><i class="bi bi-trash"></i></button>

                          <a title="edit" href="{{route('casestudy.edit',['id'=>$cd->id])}}" class="btn btn-primary btn-sm " data-id="{{$cd->id}}"><i class="bi bi-pencil"></i></a> 
                          
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="5" class="text-center">No record found</td>
                    </tr>
                  @endif

                </tbody>
              </table>
              {{ $casestudies->links() }}

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
                     Are you sure you want to delete?.
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
  var delurl="{{url('admin/casestudy')}}";
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
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
          <li class="breadcrumb-item active">Solution Menu</li>
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
                  
                  <h5 class="card-title ">Menu</h5>
                  <div>
                  <a href="{{route('admin.header.menu.create')}}" class="btn btn-primary  "><i class="bi bi-plus"></i> Add menu item</a>
                  </div>
              
                </div>
                <div class="container-fluid">
                  <div id="tree"></div>
              </div>


<div id="treeview4" class="treeview d-none">
   <ul class="list-group">
      @if($menus->isNotEmpty())
        @foreach($menus as $i=>$nr)
          <li class="list-group-item d-flex justify-content-between align-items-center" > {{$nr->title}} <span><span class="badge bg-danger rounded-pill"><i class="bi bi-trash"></i></span><span class="badge bg-primary rounded-pill"><i class="bi bi-plus"></i></span></span></li>
          @if($nr->children->isNotEmpty())
          
            @foreach($nr->children as $i=>$n)
              <li class="list-group-item " ><span class="indent"></span>{{$n->title}}</li>
                @if($n->children->isNotEmpty())
                   @foreach($n->children as $i=>$nc)
                       <li class="list-group-item " ><span class="indent"></span><span class="indent"></span>
                        {{$nc->title}}</li>
                    @endforeach
                @endif
            @endforeach
            
          @endif
        @endforeach
      @endif
      
   </ul>
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

                          <a title="edit" href="{{route('admin.header.menu.edit',['id'=>$n->id])}}" class="btn btn-primary btn-sm " data-id="{{$n->id}}"><i class="bi bi-pencil"></i></a>
                          
                        </td>
                      </tr>
                        @if($n->children->isNotEmpty())
                           @foreach($n->children as $i=>$nc)
                               <tr>
                                <td><span class="indent"></span> <span class="indent"></span>{{$nc->title}}</td>                        
                                <td>
                                  <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$nc->id}}"><i class="bi bi-trash"></i></button>

                                  <a title="edit" href="{{route('admin.header.menu.edit',['id'=>$nc->id])}}" class="btn btn-primary btn-sm " data-id="{{$nc->id}}"><i class="bi bi-pencil"></i></a>
                                  
                                </td>
                              </tr>
                              @if($nc->children->isNotEmpty())
                                @foreach($nc->children as $i=>$ncs)
                                    <tr>
                                      <td><span class="indent"></span> <span class="indent"></span><span class="indent"></span>{{$ncs->title}}</td>                        
                                      <td>
                                        <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$ncs->id}}"><i class="bi bi-trash"></i></button>

                                        <a title="edit" href="{{route('admin.header.menu.edit',['id'=>$ncs->id])}}" class="btn btn-primary btn-sm " data-id="{{$ncs->id}}"><i class="bi bi-pencil"></i></a>
                                        
                                      </td>
                                    </tr>
                                  @endforeach
                              @endif
                            @endforeach
                        @endif
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
                     Are you sure you want to delete menu item?
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
@endsection
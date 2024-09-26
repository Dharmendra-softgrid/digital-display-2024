@extends('admin.layouts.app')
@section('styles')
<!-- <link href="{{asset('/')}}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('/')}}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <style type="text/css">
    .tox-promotion,.tox-statusbar__branding{
      display: none;
    }
    .addimage{
      cursor: pointer;
    }
    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .error{
      color: red;
    }
    .image-holder{
    width: 80px;
  }
  .product_img{
    width: 100%;
    height: 80px;
    object-fit: cover;
  }
   .selected
    {
        background-color: #666;
        color: #fff;
    }
   
  </style>
@endsection
@section('content')

    <div class="pagetitle">
      <h1>Home page slider</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Image slider</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<section class="section">
  <div class="card">
    <div class="card-body">
      @include('admin.shared.displaymsg')
      <div class="d-flex justify-content-between mt-4">
        <h5 class="card-title">Home Page Slider</h5>
        <div>
          <a href="#" class="btn btn-primary addimage"><i class="bi bi-plus"></i> Add Slides</a>
        </div>
      </div>
      <div class="table-responsive">
              <table class="table table-bordered " id="homeslider">
                <thead>
                  <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Desktop Image</th>                    
                    <th scope="col">Mobile Imame</th>                    
                    <th scope="col">Video</th>                    
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if($slides->isNotEmpty())
                    @foreach($slides as $i=>$slide)
                      <?php $svalue = !empty($slide->svalue) ? unserialize($slide->svalue) : ''; ?>
                      <tr data-id="{{$slide->id}}">
                        <td >{{$i+1}}</td>
                        <td >

                          <div class="image-holder">
                            @if(isset($svalue['d_image']))
                            <a href="{{asset('images/homeslider/'.$svalue['d_image'])}}" target="_blank">
                            <img src="{{asset('images/homeslider/'.$svalue['d_image'])}}" class="product_img">
                          </a>
                            @endif
                          </div>
                          
                        </td>
                        <td >
                          <div class="image-holder">
                            @if(isset($svalue['m_image']))
                            <a href="{{asset('images/homeslider/'.$svalue['m_image'])}}" target="_blank">
                            <img src="{{asset('images/homeslider/'.$svalue['m_image'])}}" class="product_img">
                            </a>
                            @endif
                          </div>
                        </td>
                        <td ><div class="image-holder">
                            @if(isset($svalue['youtube_url']))
                            <?php preg_match('/[\?\&]v=([^\?\&]+)/', $svalue['youtube_url'], $matches ); ?>
                            <a href="{{$svalue['youtube_url']}}" target="_blank">
                              <img src="http://img.youtube.com/vi/{{$matches[1]}}/0.jpg" class="product_img">
                            </a>
                            @endif
                          </div></td>
                        
                        <td width="8%">
                          <button title="delete" type="button" class="btn btn-danger btn-sm deletebtn" data-id="{{$slide->id}}"><i class="bi bi-trash"></i></button>

                          
                          
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
</section>
<form id="imageform " class="d-none">
  <input type="file" name="media" id="productmedia">
</form>
<div id="upload-form-modal" class="modal fade" role="dialog" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                      <h5 class="modal-title">Add Slider</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{route('home.image.slider.save')}}" id="sliderfrm">
                        @csrf
                      <div class="mb-4">
                          <label for="slider-type">Select slider type</label>
                           <select class="form-control" name="slider_type" id="slider-type">
                             <option value="1">Image</option>
                             <option value="2">Youtube video</option>
                           </select>
                      </div>
                      <div class="image-type">
                        <div class="mb-4">
                            <label for="slider-type">Desktop Slider Image <small style="font-size:11px;">dimension(1920x363)</small></label>
                            <div class="d_image">
                             <button class="btn btn-primary add-s-image" data-type="d_image" type="button">Add Image</button>
                           </div>
                           <div class="d-msg"></div>
                        </div>
                        <div class="mb-4">
                            <label for="slider-type">Mobile Slider Images <small style="font-size:11px;"> dimension(1000x500)</small></label>
                             <div class="m_image">
                             <button class="btn btn-primary add-s-image" data-type="m_image" type="button">Add Image</button>
                           </div>
                           <div class="m-msg"></div>
                        </div>
                      </div>
                      <div class="youtube-type d-none">
                        <div class="mb-4">
                            <label for="slider-type">Youtube link</label>
                             <input type="text" name="youtube_url" class="form-control" id="youtube-url">
                             <div class="y-msg"></div>
                        </div>
                        
                      </div>
                      <div class="mb-4">
                          <button type="button" class="btn btn-primary savefrm" >Save</button>
                      </div>
                    </form>
                    </div>
                    
      </div>
    </div>
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
                     Are you sure you want to delete Slide ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="button" class="btn btn-danger" id="yesdelete">Yes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var ctype;
    $(document).on('click','.add-s-image',function(){
      ctype = $(this).data('type');
      $('#productmedia').click();
    });

    $('.addimage').click(function(){
      $('#upload-form-modal').modal('show');
    });
    $('#slider-type').change(function(){
      var stype = $(this).val();
      if(stype == "1"){
        $('.image-type').removeClass('d-none');
        $('.youtube-type').addClass('d-none');
      }else{
        $('.image-type').addClass('d-none');
        $('.youtube-type').removeClass('d-none');
      }
    });

    $( "#imagesortable" ).sortable({
       cancel: ".unsortable,input,textarea"     
    });
    $( "#mobileimagesortable" ).sortable({
       cancel: ".mobileimageunsortable,input,textarea"     
    });
    
    
    $('body').on('click','.deleteimage',function(){
      var stype = $(this).data("type");
      
      $('.'+stype).html('<button class="btn btn-primary add-s-image" data-type="'+stype+'" type="button">Add Image</button>');
    });
    $('#productmedia').change(function(){
      var file_data = $('#productmedia').prop('files')[0];
      var form_data = new FormData();
      form_data.append('FileInput', file_data);
      form_data.append('path', "images/homeslider");
      form_data.append('type', "homesliderImage");
      form_data.append('_token', "{{csrf_token()}}");
      $.ajax({
          url: "{{route('imageuploader.imagesupload')}}", // point to server-side controller method
          dataType: 'json', // what to expect back from the server
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function (response) {
            if(response.status){
              var cart=`<div class="row"><div class="col-sm-12">
                    <div class="card ">
                    <input type="hidden" name="`+ctype+`" value="`+response.filename+`">
                    <img src="`+response.url+`" class="card-img-top" alt="...">
                    <div class="card-body text-center ">
                      <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage" data-type="`+ctype+`"><i class="bi bi-trash"></i></button>
                     
                    </div>
                  </div>
                  </div></div>`;
                $('.'+ctype).html(cart);
            }
          },
          error: function (response) {
              $('#msg').html(response); // display error response from the server
          }
      });
    });
  });
   function validateYouTubeUrl(url)
      {
          
              if (url != undefined || url != '') {
                  var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                  var match = url.match(regExp);
                  if (match && match[2].length == 11) {
                      return match[2];
                      //$('#ytplayerSide').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=0');
                  }
                  else {
                      return false;
                  }
              }
      }
      $('.savefrm').click(function(e){
      
        var sts=true;
        e.preventDefault();
        if($("#slider-type").val() == '1' && !$(".d_image").find("input[type=hidden]").val()){
          $('.d-msg').html("<div class='error'>Please upload desttop image</div>");
          
          sts =false;
        }else{
          $('.d-msg').html("");
        }
        if($("#slider-type").val() == '1' && !$(".m_image").find("input[type=hidden]").val()){
          $('.m-msg').html("<div class='error'>Please upload mobile image</div>");
          
          sts =false;
        }else{
          $('.m-msg').html("");
        }
        
        if($("#slider-type").val() == '2' && ($("#youtube-url").val() == "" || !validateYouTubeUrl($("#youtube-url").val()))){
          $('.y-msg').html("<div class='error'>Please add valid url</div>");
          
          sts =false;
        }else{
          $('.y-msg').html("");
        }
        
        if(sts){
          $('#sliderfrm').submit();
        }

      });
</script>

<script type="text/javascript" src="{{asset('/')}}assets/js/fileuploader.js"></script> 
<script type="text/javascript">
  var delid;
  var delurl="{{url('admin/home/image-slider')}}";
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function () {
    $("#homeslider").sortable({
        items: 'tr',
        cursor: 'pointer',
        axis: 'y',
        dropOnEmpty: false,
        start: function (e, ui) {
            ui.item.addClass("selected");
        },
        stop: function (e, ui) {
            ui.item.removeClass("selected");
            var orders=[];
            $(this).find("tr").each(function (index) {
              orders.push($(this).data('id'));
                
            });
            $.ajax({
              url: "{{route('home.image.slider.order')}}", // point to server-side controller method              
              data: {'orders':orders, '_token': "{{csrf_token()}}"},
              type: 'post',
              success: function (response) {
                if(response.status){
                  window.location.reload();
                }
              }
          });
        }
    });
});
</script>
@endsection

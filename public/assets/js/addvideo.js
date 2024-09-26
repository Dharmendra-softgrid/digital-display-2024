$(document).ready(function() {    
    $('.addvideo').click(function(){
        $('#addvideopopup').modal('show');
    });
    
    $('#saveurl').click(function(){
      var embebdurl = validateYouTubeUrl($('#youTubeUrl').val());
      var vtitle = $('#videotitle').val();
      var vdesc = $('#videodescription').val();
      if(!embebdurl){
        $('.videoerror').html('<div class="text-danger">Invalid youtube url.</div>');
      }else if(vtitle==''){
        $('.videoerror').html('<div class="text-danger">Video title can not empty.</div>');
      }else if(vdesc==''){
        $('.videoerror').html('<div class="text-danger">Video description can not empty.</div>');
      }else{
        $('#addvideopopup').modal('hide');
        $('.videoerror').html('');
        $('#youTubeUrl').val('');
        $('#videotitle').val('');
        $('#videodescription').val('');
        
        var cart=`<div class="col-sm-12 col-md-12 video-container">
                            <div class="card">
                              <div class="card-header"></div>
                              <div class="card-body">
                                <div class="row align-items-center">
                                  <div class="col-md-3">
                                      <input type="hidden" value="https://www.youtube.com/embed/`+embebdurl+`" name="videos[]">
                                      <a href="https://www.youtube.com/embed/`+embebdurl+`" target="_blank"><img class="fullWidthImage" src="http://img.youtube.com/vi/`+embebdurl+`/0.jpg" alt="Cover Image" ></a>
                                  </div>
                                  <div class="col-md-8">
                                    <div>
                                      <label>Title</label>
                                      <input type="text" name="vtitle[]" class="form-control" value="`+vtitle+`">
                                    </div>
                                    <div>
                                      <label>Description</label>
                                      <textarea name="vdesc[]" class="form-control">`+vdesc+`</textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-1 text-center">
                                    <button type="button" class="btn btn-danger btn-sm deletevideo mt-3"><i class="bi bi-trash"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>`; 
                          $('.videoitem').before(cart);
      }
    });
    $('body').on('click','.deletevideo',function(){
      $(this).closest('.video-container').remove();
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
});
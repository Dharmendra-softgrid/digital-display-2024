<style type="text/css">
  .addvideo{
      cursor: pointer;      
    }
    .addvideo img{
      height: 150px;
    }
    .fullWidthImage{
      width: 100%;
    }
</style>
<div class="row " id="videoSortable">
                      @if(!empty($videos) )
                        @foreach($videos as $pvideo)
                         <?php  $value= isset($key) ? $pvideo->{$key} : $pvideo->video;
                            if(isset($key) && $key=='svalue'){
                              $un = unserialize($pvideo->{$key});
                              $value = $un['url'];
                              $pvideo->title = $un['title'];
                              $pvideo->description = $un['description'];
                            }
                          ?>
                          <div class="col-sm-12 col-md-12 video-container">
                            <div class="card">
                              <div class="card-header"></div>
                              <div class="card-body">
                                <div class="row align-items-center">
                                  <div class="col-md-3">
                                      <input type="hidden" value="{{$value}}" name="videos[]">
                                      <a href="{{$value}}" target="_blank"><img class="fullWidthImage" src="http://img.youtube.com/vi/{{str_replace('https://www.youtube.com/embed/','',$value)}}/0.jpg" alt="Cover Image" ></a>
                                  </div>
                                  <div class="col-md-8">
                                    <div>
                                      <label>Title</label>
                                      <input type="text" name="vtitle[]" class="form-control" value="{{$pvideo->title}}" onClick="this.focus();">
                                    </div>
                                    <div>
                                      <label>Description</label>
                                      <textarea name="vdesc[]" class="form-control" onClick="this.focus();">{{$pvideo->description}}</textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-1 text-center">
                                    <button type="button" class="btn btn-danger btn-sm deletevideo mt-3"><i class="bi bi-trash"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @endif
                      <div class="col-sm-6 col-md-3 videoitem videounsortable">
                        <div class="card addvideo">
                        <img src="{{asset('/')}}assets/img/default-video-thumbnail.jpg" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                          <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                         
                        </div>
                      </div>
                      </div>
                      
                      
                    </div>
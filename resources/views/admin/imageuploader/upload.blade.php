<form name="frmimageuploader" id="frmimageuploader" action="{{ route('imageuploader.imagesupload') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="modal-header">
  <h5 class="modal-title">Upload Image </h5>
  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="padding-10 white-background fileupload imagesupload">
    <div class="form">
      <input type="hidden" name="type" id="type" value="{{ $type??'' }}">
      <input type="hidden" name="imageId" value="{{ $imageId??'' }}">
      <input type="hidden" name="imgTagId" value="{{ $imgTagId??''}}">
      <input type="hidden" name="path" value="{{ $awspath??''}}">
      <!-- <div class="form-group">
        <input name="title" type="text" id="title" placeholder="Title" maxlength="100" value="" />
      </div> -->
      <input name="title" type="hidden" id="title" value="image" />
      <div class="form-group">
        <label class="label">Image:</label>
        <input type="file" name="FileInput" id="FileInput" value="">
      </div>
      <div id="progressbox" >
        <div id="uploadbar">
          <div id="progressbar"></div >
        </div>
        <div id="statustxt">0%</div>
      </div>
      <div id="output"></div>
      <div class="fileerror"></div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-inline" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
  <button type="submit" class="btn btn-inline btn-primary" name="submit" value="save">Save</button>&nbsp;
</div>
</form>

<script>
ajaxfileupload();
</script>

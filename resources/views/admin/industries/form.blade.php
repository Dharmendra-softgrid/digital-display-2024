@extends('admin.layouts.app')
@section('styles')
    <!-- <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
              <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .tox-promotion,
        .tox-statusbar__branding {
            display: none;
        }

        .addimage {
            cursor: pointer;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        #bannerimagepreview {
            height: 100px;
        }

        #iconpreview {
            height: 100px;
        }

        .d-flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .d-flex-center h4 {
            flex-grow: 1;
            text-align: center;
        }

        .d-flex-center button {
            position: absolute;
            right: 0;
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Industry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Industry</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.shared.displaymsg')

                        <form method="POST" action="{{ route('industry.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="card-title">Industry</h5>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Industry Name <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    @if (!empty($industry->id))
                                        <input type="hidden" name="id" value="{{ $industry->id }}">
                                    @endif
                                    <input type="text" name="title" class="form-control"
                                        value="{{ isset($industry->title) ? $industry->title : '' }}">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Title</label>
                                <div class="col-md-10">
                                    <input type="text" name="heading" class="form-control"
                                        value="{{ old('meta_title', isset($industry->heading) ? $industry->heading : '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ old('meta_title', isset($industry->meta_title) ? $industry->meta_title : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_keywords" class="form-control"
                                        value="{{ old('meta_keywords', isset($industry->meta_keywords) ? $industry->meta_keywords : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                                <div class="col-md-10">
                                    <textarea name="meta_description" class="form-control">{{ old('meta_description', isset($industry->meta_description) ? $industry->meta_description : '') }}</textarea>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Content <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    <textarea name="content" id="content" class="content">{{ isset($industry->content) ? $industry->content : '' }}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                              <label for="inputText" class="col-md-2 col-form-label">Sub-heading</label>
                              <div class="col-md-10">
                               <input type="text" name="sub_heading" class="form-control" value="{{ old('meta_title', isset($industry->sub_heading) ? $industry->sub_heading : '') }}">
                              </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Gallery Images</label>
                              <div class="col-sm-10">
                                <div class="row " id="imagesortable">
                                  @if (isset($industry) && $industry->images->isNotEmpty())
    @foreach ($industry->images as $pimage)
    <div class="col-md-3">
                                        <div class="card ">
                                        <input type="hidden" name="images[]" value="{{ $pimage->image }}">
                                        <img src="{{ asset('assets/img/industry/' . $pimage->image) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center ">
                                          <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                                         
                                        </div>
                                      </div>
                                      </div>
    @endforeach
    @endif
                                  <div class="col-md-3 imageitem unsortable">
                                    <div class="card addimage">
                                    <img src="{{ asset('/') }}images/product/productDefault.png" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                      <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                                     
                                    </div>
                                  </div>
                                  </div>
                                  
                                </div>
                                @if ($errors->has('images'))
    <div class="text-danger">{{ $errors->first('images') }}</div>
    @endif
                              </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Youtube video</label>
                              <div class="col-sm-10">
                                @include('admin.shared.addvideo', [
                                    'videos' =>
                                        isset($industry) && $industry->videos->isNotEmpty()
                                            ? $industry->videos
                                            : '',
                                ])
                              </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Logo <br> </label>
                          <div class="col-sm-10">
                            <div class="card ">

                              <img src="{{ asset(isset($industry->banner_image) ? 'images/' . $industry->banner_image : 'images/computerbanner.jpg') }}" class="banner-img" alt="..." id="bannerimagepreview">
                              <div class="card-body text-center ">
                                <button type="button" class="btn btn-primary btn-sm mt-3 " id="addbannerimage"><i class="bi bi-pencil"></i></button>
                              </div>
                            </div>
                            @if ($errors->has('bannerimage'))
    <div class="text-danger">{{ str_replace('bannerimage', 'banner image', $errors->first('bannerimage')) }}</div>
    @endif
                            <div class="msg"></div>
                          </div>
                        </div> -->
                            <!-- <input type="file" name="bannerimage" id="bannerimage" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif"> -->

                            {{-- <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Icon for slider <br> <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                  <div class="col-sm-10">
                    <div class="card ">
                       
                        <img src="{{asset(isset($industry->icon) ? 'images/'.$industry->icon : 'images/computerbanner.jpg')}}" class="banner-img" alt="..." id="bannerimagepreview">
            <div class="card-body text-center ">
              <button type="button" class="btn btn-primary btn-sm mt-3 " id="addicon"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
        @if ($errors->has('icon'))
        <div class="text-danger">{{ str_replace("icon","banner image",$errors->first('icon')) }}</div>
        @endif
        <div class="msg"></div>
      </div>
    </div>
    <input type="file" name="icon" id="icon" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif">
    --}}

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Industry Content</label>
                                <div class="col-sm-10" id="sectionSortable">
                                    <div class="row bimagec sectionunsortable">
                                        <div class="col-sm-12 mb-3"><button type="button"
                                                class="btn btn-primary btn-sm float-end addblog"><i
                                                    class="bi bi-plus"></i> Add Section</button></div>
                                    </div>
                                    @if (isset($industry) && $industry->IndustryDetail->isNotEmpty())
                                        @foreach ($industry->IndustryDetail as $IndustryDetail)
                                            <div class="remove-section">
                                                <div class="col-sm-12">
                                                    <div class="card p-3">
                                                        <div class="row ">
                                                            <div class="col-sm-8">
                                                                <label for="inputEmail3"
                                                                    class="col-form-label">Title</label>
                                                                <input type="text" name="ititle[]"
                                                                    class="form-control" placeholder="Title"
                                                                    value="{{ $IndustryDetail->title }}">
                                                                <label for="inputEmail3"
                                                                    class="col-form-label">Position</label>
                                                                <select class="form-control js-example-basic-single"
                                                                    name="iposition[]">
                                                                    <option disabled selected>Select One</option>
                                                                    <option value="Left"
                                                                        @if (isset($IndustryDetail->position)) {{ $IndustryDetail->position == 'Left' ? 'selected' : '' }} @endif>
                                                                        Left
                                                                    </option>
                                                                    <option value="Right"
                                                                        @if (isset($IndustryDetail->position)) {{ $IndustryDetail->position == 'Right' ? 'selected' : '' }} @endif>
                                                                        Right
                                                                    </option>
                                                                </select>
                                                                @if ($errors->has('position'))
                                                                    <div class="text-danger">
                                                                        {{ $errors->first('position') }}</div>
                                                                @endif

                                                                <label for="inputEmail3"
                                                                    class="col-form-label">Content</label>
                                                                <textarea class="form-control" name="icontent[]">{{ $IndustryDetail->content }}</textarea>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="card addblogimage mb-0">
                                                                    <input type="hidden" name="iimage[]"
                                                                        value="{{ $IndustryDetail->image }}">
                                                                    <img src="{{ asset('images/' . $IndustryDetail->image) }}"
                                                                        class="card-img-top" alt="...">
                                                                    <div class="card-body text-center">
                                                                        <button type="button"
                                                                            class="btn btn-primary btn-sm mt-3"><i
                                                                                class="bi bi-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm float-end deleteblogimage"><i
                                                                        class="bi bi-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="remove-section">
                                            <div class="col-sm-12">
                                                <div class="card p-3">
                                                    <div class="row ">
                                                        <div class="col-sm-8">
                                                            <label for="inputEmail3" class="col-form-label">Title</label>
                                                            <input type="text" name="ititle[]" class="form-control"
                                                                placeholder="Title" value="">
                                                            <label for="inputEmail3"
                                                                class="col-form-label">Position</label>
                                                            <select class="form-control js-example-basic-single"
                                                                name="iposition[]">
                                                                <option disabled selected>Select One</option>
                                                                <option value="Left">Left</option>
                                                                <option value="Right">Right</option>
                                                            </select>
                                                            @if ($errors->has('position'))
                                                                <div class="text-danger">{{ $errors->first('position') }}
                                                                </div>
                                                            @endif

                                                            <label for="inputEmail3"
                                                                class="col-form-label">Content</label>
                                                            <textarea class="form-control" name="icontent[]"></textarea>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="card addblogimage mb-0">
                                                                <input type="hidden" name="iimage[]">
                                                                <img src="" class="card-img-top" alt="...">
                                                                <div class="card-body text-center">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-sm mt-3"><i
                                                                            class="bi bi-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm float-end deleteblogimage"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="row bannerimagec sectionunsortable">
                                    <div class="col-sm-12 mb-3 d-flex-center">
                                        <h4 class="card-title mb-0">Upload Banners</h4>
                                        <button type="button" class="btn btn-primary btn-sm addbanner"><i
                                                class="bi bi-plus"></i>
                                            Add Section</button>
                                    </div>
                                </div>
                                <?php
                                if (isset($industry)) {
                                    $banner_section = json_decode($industry->banner_section, true);
                                }
                                
                                ?>
                                @if (isset($banner_section))
                                    @foreach ($banner_section as $index => $value)
                                        <div class="remove-section">
                                            <div class="col-sm-12">
                                                <div class="card p-3">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label for="btitle{{ $index }}"
                                                                class="col-form-label">Title</label>
                                                            <input type="text" id="btitle{{ $index }}"
                                                                name="btitle[]" class="form-control" placeholder="Title"
                                                                value="{{ $value['btitle'] }}">

                                                            <label for="bcontent{{ $index }}"
                                                                class="col-form-label">Content</label>
                                                            <textarea id="bcontent{{ $index }}" class="form-control" name="bcontent[]">{{ $value['bcontent'] }}</textarea>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="card addbannerimage mb-0">
                                                                <input type="hidden" name="bimage[]"
                                                                    value="{{ $value['bimage'] }}">
                                                                <img src="{{ asset(isset($value['bimage']) ? 'images/' . $value['bimage'] : 'images/computerbanner.jpg') }}"
                                                                    class="banner-img bannerimagepreview" alt="...">
                                                                <div class="card-body text-center">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-sm mt-3"><i
                                                                            class="bi bi-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm float-end deletebannerimage"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="remove-section">
                                        <div class="col-sm-12">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label for="btitle" class="col-form-label">Title</label>
                                                        <input type="text" id="btitle" name="btitle[]"
                                                            class="form-control" placeholder="Title" value="">

                                                        <label for="bcontent" class="col-form-label">Content</label>
                                                        <textarea id="bcontent" class="form-control" name="bcontent[]"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="card addbannerimage mb-0">
                                                            <input type="hidden" name="bimage[]">
                                                            <img src="" class="card-img-top" alt="...">
                                                            <div class="card-body text-center">
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm mt-3"><i
                                                                        class="bi bi-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm float-end deletebannerimage"><i
                                                                class="bi bi-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <form id="imageform " class="d-none">
        <input type="file" name="media" id="productmedia" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="image" class="d-none">
        <input type="file" name="media" id="blogimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="bannerimage" class="d-none">
        <input type="file" name="bimage[]" id="bannerimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    @include('admin.shared.videopopup')
@endsection
@section('scripts')
    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
            <script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        var editorsHight = 500;
        var editorimageuploadurl = "{{ route('imageuploader.imagesupload') }}";
        var csrftoken = "{{ csrf_token() }}";

        $(document).ready(function() {
            $('.addimage').click(function() {
                $('#productmedia').click();
            });
            $("#imagesortable").sortable({
                cancel: ".unsortable,input,textarea"
            });

            $("#videoSortable").sortable({
                cancel: ".videounsortable,input,textarea"
            });


            $('body').on('click', '.deleteimage', function() {
                $(this).closest('.col-md-3').remove();
            });


            $('#productmedia').change(function() {
                var file_data = $('#productmedia').prop('files')[0];
                var form_data = new FormData();
                form_data.append('FileInput', file_data);
                form_data.append('path', "assets/img/industry");
                form_data.append('type', "productimage");
                form_data.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('imageuploader.imagesupload') }}", // point to server-side controller method
                    dataType: 'json', // what to expect back from the server
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response) {
                        if (response.status) {
                            var cart = `<div class="col-md-3">
                    <div class="card ">
                    <input type="hidden" name="images[]" value="` + response.filename + `">
                    <img src="` + response.url + `" class="card-img-top" alt="...">
                    <div class="card-body text-center ">
                      <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                     
                    </div>
                  </div>
                  </div>`;
                            $('.imageitem').before(cart);
                            $('#imagesortable').next('.text-danger').remove();
                        }
                    },
                    error: function(response) {
                        if (response.status == 422 && typeof(response.responseJSON.errors) !=
                            "undefined" && typeof(response.responseJSON.errors.FileInput) !=
                            "undefined") {
                            $('#imagesortable').after('<div class="text-danger">' + response
                                .responseJSON.errors.FileInput.toString() + '</div>');
                        } else {
                            $('#imagesortable').after('<div class="text-danger">' + response
                                .responseJSON.message + '</div>');
                        }
                    }
                });
            });

            $('#addbannerimage').click(function() {
                $('#bannerimage').click();
            });
            $('#bannerimage').change(function() {
                const file = this.files[0];
                var sizeKB = file.size / 1024;
                if (sizeKB > 2048) {
                    $('.msg').html(
                        '<div class="text-danger">The banner image may not be greater than 2048 kilobytes</div>'
                    );
                    return;
                } else if (!file.name.match(/\.(jpg|jpeg|png|gif|svg)$/)) {
                    $('.msg').html(
                        '<div class="text-danger">The banner image must be a file of type: jpeg, png, jpg, gif.</div>'
                    );
                    return;
                } else {
                    $('.msg').html('');
                }
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#bannerimagepreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            $('#addicon').click(function() {
                $('#icon').click();
            });
            $('#icon').change(function() {
                const file = this.files[0];
                var sizeKB = file.size / 1024;
                if (sizeKB > 2048) {
                    $('.msg').html(
                        '<div class="text-danger">The banner image may not be greater than 2048 kilobytes</div>'
                    );
                    return;
                } else if (!file.name.match(/\.(jpg|jpeg|png|gif|svg)$/)) {
                    $('.msg').html(
                        '<div class="text-danger">The banner image must be a file of type: jpeg, png, jpg, gif.</div>'
                    );
                    return;
                } else {
                    $('.msg').html('');
                }
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#iconpreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $("#sectionSortable").sortable({
                cancel: ".sectionunsortable,input,textarea"
            });
            var bimage;
            $('body').on('click', '.addblogimage', function() {
                bimage = $(this);
                $('#blogimagefile').click();
            });
            $('#blogimagefile').change(function() {
                var file_data = $('#blogimagefile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('FileInput', file_data);
                form_data.append('path', "images");
                form_data.append('type', "productblogimage");
                form_data.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('imageuploader.imagesupload') }}", // point to server-side controller method
                    dataType: 'json', // what to expect back from the server
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response) {
                        if (response.status) {
                            bimage.find('input').val(response.filename);
                            bimage.find('img').attr('src', response.url);

                        }
                        $('#image')[0].reset();
                    },
                    error: function(response) {
                        $('#msg').html(response); // display error response from the server
                    }
                });
            });
            $(document).ready(function() {
                $(".js-example-basic-single").select2({
                    minimumResultsForSearch: Infinity
                })
            });

            $('.addblog').click(function() {
                var spec = `<div class="remove-section">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="inputEmail3" class="col-form-label">title</label>
                                    <input type="text" name="ititle[]" class="form-control" placeholder="Title">
                                    <label for="inputEmail3" class="col-form-label">Position</label>
                                    <select class="form-control js-example-basic-single" name="iposition[]">
                                        <option disabled selected>Select One</option>
                                        <option value="LEFT">Left</option>
                                        <option value="RIGHT">Right</option>
                                    </select>
                                    <label for="inputEmail3" class="col-form-label">Content</label>
                                    <textarea class="form-control" name="icontent[]"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card addblogimage mb-0">
                                        <input type="hidden" name="iimage[]">
                                        <img src="{{ asset('/') }}images/product/productDefault.png" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"><button type="button" class="btn btn-danger btn-sm float-end deleteblogimage"><i class="bi bi-trash"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.bimagec').after(spec);

                // Initialize Select2 on the newly added dropdown
                $('.js-example-basic-single').select2({
                    minimumResultsForSearch: Infinity
                });
            });

            $('body').on('click', '.deleteblogimage', function() {
                $(this).closest('.remove-section').remove();
            });

        })
        $('.addbanner').click(function() {
            var spec = `<div class="remove-section">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="inputEmail3" class="col-form-label">title</label>
                                    <input type="text" name="btitle[]" class="form-control" placeholder="Title">
                                    
                                    <label for="inputEmail3" class="col-form-label">Content</label>
                                    <textarea class="form-control" name="bcontent[]"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card addbannerimage mb-0">
                                        <input type="hidden" name="bimage[]">
                                        <img src="{{ asset('/') }}images/product/productDefault.png" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"><button type="button" class="btn btn-danger btn-sm float-end deletebannerimage"><i class="bi bi-trash"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>`;

            $('.bannerimagec').after(spec);

            // Initialize Select2 on the newly added dropdown
            $('.js-example-basic-single').select2({
                minimumResultsForSearch: Infinity
            });
        });
        $('body').on('click', '.deletebannerimage', function() {
            $(this).closest('.remove-section').remove();
        });
        $('body').on('click', '.addbannerimage', function() {
            bimage = $(this);
            $('#bannerimagefile').click();
        });
        $('#bannerimagefile').change(function() {
            var file_data = $('#bannerimagefile').prop('files')[0];
            var form_data = new FormData();
            form_data.append('FileInput', file_data);
            form_data.append('path', "images");
            form_data.append('type', "productbannerimage");
            form_data.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('imageuploader.imagesupload') }}", // point to server-side controller method
                dataType: 'json', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    if (response.status) {
                        bimage.find('input').val(response.filename);
                        bimage.find('img').attr('src', response.url);

                    }
                    $('#image')[0].reset();
                },
                error: function(response) {
                    $('#msg').html(response); // display error response from the server
                }
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/editors.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/addvideo.js"></script>
@endsection

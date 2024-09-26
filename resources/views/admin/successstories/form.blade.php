@extends('admin.layouts.app')
@section('styles')
    <!-- <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
                                          <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
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

        .bannerimagepreview {
            width: 200px;
        }

        .bannerimagepreview1 {
            width: 200px;
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
        <h1>Success Story</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Success Story</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">




                <div class="card">
                    <div class="card-body">
                        @include('admin.shared.displaymsg')

                        <form method="POST" action="{{ route('successstory.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="card-title">Story</h5>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Title</label>
                                <div class="col-md-10">
                                    @if (!empty($successstory->id))
                                        <input type="hidden" name="id" value="{{ $successstory->id }}">
                                    @endif
                                    <input type="text" name="title" class="form-control"
                                        value="{{ isset($successstory->title) ? $successstory->title : '' }}">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Short Description</label>
                                <div class="col-md-10">
                                    <input type="text" name="short_description" class="form-control"
                                        value="{{ isset($successstory->short_description) ? $successstory->short_description : '' }}">
                                    @if ($errors->has('short_description'))
                                        <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Year</label>
                                <div class="col-md-10">
                                    <input type="text" name="year" class="form-control"
                                        value="{{ isset($successstory->year) ? $successstory->year : '' }}">
                                    @if ($errors->has('year'))
                                        <div class="text-danger">{{ $errors->first('year') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Company</label>
                                <div class="col-md-10">
                                    <input type="text" name="company" class="form-control"
                                        value="{{ isset($successstory->company) ? $successstory->company : '' }}">
                                    @if ($errors->has('company'))
                                        <div class="text-danger">{{ $errors->first('company') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Type</label>
                                <div class="col-md-10">
                                    <input type="text" name="type" class="form-control"
                                        value="{{ isset($successstory->type) ? $successstory->type : '' }}">
                                    @if ($errors->has('type'))
                                        <div class="text-danger">{{ $errors->first('type') }}</div>
                                    @endif
                                </div>
                            </div> --}}
                            <!--<div class="row mb-3">
                                                          <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                                                          <div class="col-md-10">
                                                           <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', isset($successstory->meta_title) ? $successstory->meta_title : '') }}">
                                                          </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                          <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                                                          <div class="col-md-10">
                                                           <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', isset($successstory->meta_keywords) ? $successstory->meta_keywords : '') }}">
                                                         </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                          <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                                                          <div class="col-md-10">
                                                          <textarea name="meta_description" class="form-control">{{ old('meta_description', isset($successstory->meta_description) ? $successstory->meta_description : '') }}</textarea>
                                                          
                                                         </div>
                                                        </div>-->
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Content</label>
                                <div class="col-md-10">
                                    <textarea name="content" id="content" class="content">{{ isset($successstory->content) ? $successstory->content : '' }}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>
                            </div>
                            <?php /*?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Gallery Images</label>
                                <div class="col-sm-10">
                                    <div class="row " id="imagesortable">
                                        @if (isset($successstory) && $successstory->images->isNotEmpty())
                                            @foreach ($successstory->images as $pimage)
                                                <div class="col-md-3">
                                                    <div class="card ">
                                                        <input type="hidden" name="images[]"
                                                            value="{{ $pimage->image }}">
                                                        <img src="{{ asset('assets/img/industry/' . $pimage->image) }}"
                                                            class="card-img-top" alt="...">
                                                        <div class="card-body text-center ">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mt-3 deleteimage"><i
                                                                    class="bi bi-trash"></i></button>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="col-md-3 imageitem unsortable">
                                            <div class="card addimage">
                                                <img src="{{ asset('/') }}images/product/productDefault.png"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <button type="button" class="btn btn-primary btn-sm mt-3"><i
                                                            class="bi bi-plus"></i></button>

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
                                                                    isset($successstory) &&
                                                                    $successstory->videos->isNotEmpty()
                                                                        ? $successstory->videos
                                                                        : '',
                                                            ])
                                                          </div>
                                                        </div> <?php */?>
                                                        <div class="row mb-3">
                                                          <label for="inputEmail3" class="col-sm-2 col-form-label">Image <br> <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                            <div class="col-sm-10">
                                <div class="card ">

                                    <img src="{{ asset(isset($successstory->banner_image) ? 'images/' . $successstory->banner_image : 'images/computerbanner.jpg') }}"
                                        class="banner-img bannerimagepreview" alt="...">
                                    <div class="card-body text-center ">
                                        <button type="button" class="btn btn-primary btn-sm mt-3 addbannerimage"
                                            id=""><i class="bi bi-pencil"></i></button>
                                    </div>
                                </div>
                                @if ($errors->has('bannerimage'))
                                    <div class="text-danger">
                                        {{ str_replace('bannerimage', 'banner image', $errors->first('bannerimage')) }}
                                    </div>
                                @endif
                                <div class="msg"></div>
                            </div>

                    </div>
                    <input type="file" name="bannerimage" id="" class="d-none bannerimage"
                        accept="image/png, image/jpeg, image/jpg, image/gif">
                    <div class="row mb-3">
                        <div class="row bimagec sectionunsortable">
                            <div class="col-sm-12 mb-3 d-flex-center">
                                <h4 class="card-title mb-0">Upload Banners</h4>
                                <button type="button" class="btn btn-primary btn-sm addblog"><i class="bi bi-plus"></i>
                                    Add Section</button>
                            </div>
                        </div>
                        <?php
                        if (isset($successstory)) {
                            $banner_section = json_decode($successstory->banner_section, true);
                        }
                        
                        ?>
                        @if (isset($banner_section))
                            @foreach ($banner_section as $index => $value)
                                <div class="remove-section">
                                    <div class="col-sm-12">
                                        <div class="card p-3">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <label for="ititle{{ $index }}"
                                                        class="col-form-label">Title</label>
                                                    <input type="text" id="ititle{{ $index }}" name="ititle[]"
                                                        class="form-control" placeholder="Title"
                                                        value="{{ $value['ititle'] }}">

                                                    <label for="icontent{{ $index }}"
                                                        class="col-form-label">Content</label>
                                                    <textarea id="icontent{{ $index }}" class="form-control" name="icontent[]">{{ $value['icontent'] }}</textarea>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="card addblogimage mb-0">
                                                        <input type="hidden" name="iimage[]"
                                                            value="{{ $value['iimage'] }}">
                                                        <img src="{{ asset(isset($value['iimage']) ? 'images/' . $value['iimage'] : 'images/computerbanner.jpg') }}"
                                                            class="banner-img bannerimagepreview" alt="...">
                                                        <div class="card-body text-center">
                                                            <button type="button" class="btn btn-primary btn-sm mt-3"><i
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
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label for="ititle" class="col-form-label">Title</label>
                                                <input type="text" id="ititle" name="ititle[]"
                                                    class="form-control" placeholder="Title" value="">

                                                <label for="icontent" class="col-form-label">Content</label>
                                                <textarea id="icontent" class="form-control" name="icontent[]"></textarea>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card addblogimage mb-0">
                                                    <input type="hidden" name="iimage[]">
                                                    <img src="" class="card-img-top" alt="...">
                                                    <div class="card-body text-center">
                                                        <button type="button" class="btn btn-primary btn-sm mt-3"><i
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
                        <div class="row">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <form id="imageform " class="d-none">
        <input type="file" name="media" id="productmedia" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="image" class="d-none">
        <input type="file" name="iimage[]" id="blogimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    @include('admin.shared.videopopup')
@endsection
@section('scripts')
    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
                                        <script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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

            $('.addbannerimage').click(function() {
                $('.bannerimage').click();
            });
            $('.bannerimage').change(function() {
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
                        $('.bannerimagepreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

        });
        $('.addblog').click(function() {
            var spec = `<div class="remove-section">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="inputEmail3" class="col-form-label">title</label>
                                    <input type="text" name="ititle[]" class="form-control" placeholder="Title">
                                    
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
    </script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/editors.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/addvideo.js"></script>
@endsection

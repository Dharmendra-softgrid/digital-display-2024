@extends('admin.layouts.app')
@section('styles')
    <!-- <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
                                                                                                                              <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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

        .select2 {
            width: 100% !important;
        }

        .specsheetimg {
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }

        #featuredimagepreview {
            width: 120px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
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
        <h1>{{!empty($product->id) ? 'Edit' : 'Create'}} Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                <li class="breadcrumb-item active">{{!empty($product->id) ? 'Edit' : 'Create'}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('admin.shared.displaymsg')
                <h5 class="card-title">Product</h5>
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
                    validateFileSize()">
                    <div class="row">
                        <div class="col-lg-12">


                            <!-- Horizontal Form -->

                            {{ csrf_field() }}
                            @if (!empty($product->id))
                                <input type="hidden" name="id" value="{{ $product->id }}">
                            @endif
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Product Model</label>
                                <div class="col-md-10">
                                    <input type="text" name="model" class="form-control"
                                        value="{{ old('model', isset($product->model) ? $product->model : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="product_title" class="col-sm-2 col-form-label">Product Title <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="title"
                                        class="form-control {{ $errors->has('title') ? 'border-danger' : '' }} "
                                        id="product_title"
                                        value="{{ old('title', isset($product->title) ? $product->title : '') }}">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" maxlength="60"  oninput="updateCharCount()"
                                        value="{{ old('meta_title', isset($product->meta_title) ? $product->meta_title : '') }}" >
                                        <small id="charCount" class="form-text text-muted">0/60 characters</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"  oninput="checkKeywords()"
                                        value="{{ old('meta_keywords', isset($product->meta_keywords) ? $product->meta_keywords : '') }}">
                                        <small id="keywordCount" class="form-text text-muted">0/10 keywords</small>
                                        <small id="keywordError" class="form-text text-danger" style="display:none;">You can only enter up to 10 keywords.</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                                <div class="col-md-10">
                                    <textarea name="meta_description" id="meta_description" oninput="checkWordCount()" class="form-control">{{ old('meta_description', isset($product->meta_description) ? $product->meta_description : '') }}</textarea>
                                    <small id="wordCount" class="form-text text-muted">0/180 words</small>
                                    <small id="wordError" class="form-text text-danger" style="display:none;">You can only enter up to 180 words.</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Sub-Category <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <?php $scategories = isset($product->product_categories) ? $product->product_categories->pluck('id')->toArray() : [];
                                    ?>
                                    <select name="categories[]"
                                        class="form-control {{ $errors->has('category') ? 'border-danger' : '' }}"
                                        id="categories" multiple>

                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('categories', $scategories)) ? 'Selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('categories'))
                                        <div class="text-danger">{{ $errors->first('categories') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Product Series <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-select" name="series">
                                        <option disabled selected>Select One...</option>
                                        @foreach ($series as $value)
                                            <option value="{{ $value['id'] }}"
                                                @if (!empty($product->series) && $product->series == $value['id']) selected="selected" @endif>
                                                {{ $value['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('series'))
                                        <div class="text-danger">{{ $errors->first('series') }}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Industries <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <?php $sindustries = isset($product->industries) ? $product->industries->pluck('id')->toArray() : [];
                                    ?>
                                    <select name="industries[]"
                                        class="form-control {{ $errors->has('Industries') ? 'border-danger' : '' }}"
                                        id="industries" multiple>

                                        @if ($industries->isNotEmpty())
                                            @foreach ($industries as $industry)
                                                <option value="{{ $industry->id }}"
                                                    {{ in_array($industry->id, old('industries', $sindustries)) ? 'Selected' : '' }}>
                                                    {{ $industry->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('industries'))
                                        <div class="text-danger">{{ $errors->first('industries') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="variants" class="col-sm-2 col-form-label">Product Variant <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <?php $svariants = isset($product->variants) ? $product->variants->pluck('variant')->toArray() : []; ?>
                                    <select name="variant[]"
                                        class="form-control {{ $errors->has('variant') ? 'border-danger' : '' }}"
                                        id="variants" multiple>
                                        @if ($variants->isNotEmpty())
                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->id }}"
                                                    {{ in_array($variant->id, old('variant', $svariants)) ? 'selected' : '' }}>
                                                    {{ $variant->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('variant'))
                                        <div class="text-danger">{{ $errors->first('variant') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <ul class="nav nav-tabs" id="tabList"></ul>
                            </div>

                            <div class="tab-content" id="tabContent">
                                <!-- Dynamic tab content will be added here -->
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Short Description <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="short_description"
                                        class="form-control {{ $errors->has('short_description') ? 'border-danger' : '' }} " id="">{{ old('short_description', isset($product->short_description) ? $product->short_description : '') }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control {{ $errors->has('description') ? 'border-danger' : '' }} content"
                                        id="content">{{ old('description', isset($product->description) ? $product->description : '') }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Main Image <span
                                        style="color: red; font-size: small;">*</span> (256 x 256 px)<br>
                                    <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                                <div class="col-sm-10">
                                    <div class="card ">

                                        <img src="{{ asset(isset($product->featured_image) ? 'images/' . $product->featured_image : 'images/computerbanner.jpg') }}"
                                            class="banner-img" alt="..." id="featuredimagepreview">
                                        <div class="card-body text-center ">
                                            <button type="button" class="btn btn-primary btn-sm mt-3 "
                                                id="addfeaturedimage"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </div>
                                    @if ($errors->has('featuredimage'))
                                        <div class="text-danger">
                                            {{ str_replace('featuredimage', 'banner image', $errors->first('featuredimage')) }}
                                        </div>
                                    @endif
                                    <div class="msg"></div>
                                </div>

                            </div>
                            <input type="file" name="featuredimage" id="featuredimage" class="d-none"
                                accept="image/png, image/jpeg, image/jpg, image/gif">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Images <span
                                        style="color: red; font-size: small;">*</span> (466 × 450 px)</label>
                                <div class="col-sm-10">
                                    <div class="row " id="imagesortable">
                                        @if (old('images'))
                                            @foreach (old('images') as $image)
                                                <div class="col-sm-6 col-md-3 dragimage">
                                                    <div class="card ">
                                                        <input type="hidden" name="images[]"
                                                            value="{{ $image }}">
                                                        <img src="{{ asset('images/product/' . $image) }}"
                                                            class="card-img-top" alt="...">
                                                        <div class="card-body text-center ">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mt-3 deleteimage"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif(isset($product) && $product->product_images->isNotEmpty())
                                            @foreach ($product->product_images as $pimage)
                                                <div class="col-sm-6 col-md-3 dragimage">
                                                    <div class="card ">
                                                        <input type="hidden" name="images[]"
                                                            value="{{ $pimage->image }}">
                                                        <img src="{{ asset('images/product/' . $pimage->image) }}"
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
                                        <div class="col-sm-6 col-md-3 imageitem unsortable">
                                            <div class="card addimage">
                                                <img src="{{ asset('/') }}images/product/productDefault.png"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <button type="button" class="btn btn-primary btn-sm mt-3"><i
                                                            class="bi bi-plus"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('images'))
                                            <div class="text-danger">{{ $errors->first('images') }}</div>
                                        @endif
                                        <div class="pmsg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                </form><!-- End Horizontal Form -->
            </div>
        </div>
    </section>
    <form id="imageform " class="d-none">
        <input type="file" name="media" id="productmedia" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="blogimage" class="d-none">
        <input type="file" name="media" id="blogimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="specificationimage" class="d-none">
        <input type="file" name="media" id="specificationimagefile"
            accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <div id="upload-form-modal" class="modal fade" role="dialog" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirmation Modal for pdf delete-->
    <div class="modal fade" id="confirmDeleteModalPDFDelete" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalPDFDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalPDFDeleteLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteFormPDF" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModalComponentDelete" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalComponentDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalComponentDeleteLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteFormComponent" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModalKeyFeatureSectionDelete" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalKeyFeatureSectionDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalKeyFeatureSectionDeleteLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteFormKeyFeatureSection" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.shared.videopopup')
@endsection
@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categories').select2();
            $('#variants').select2();
            $("#imagesortable").sortable({
                cancel: ".unsortable,input,textarea"
            });
            $("#sectionSortable").sortable({
                cancel: ".sectionunsortable,input,textarea"
            });
            $("#specificationSortable").sortable({
                cancel: ".specificationsortable,input,textarea"
            });
            $("#videoSortable").sortable({
                cancel: ".videounsortable,input,textarea"
            });

            $('#industries').select2();
            $('.addimage').click(function() {
                $('#productmedia').click();
            });
            $('body').on('click', '.addspecBr', function() {
                var $parentTabPane = $(this).closest('.tab-pane');
                var variantId = $parentTabPane.find('input[name="v_id[]"]').val(); // Corrected selector
                var spec = `
                    <div class="row mt-2">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Upload PDF</label>
                        <div class="col-sm-3"><input type="file" name="pdf_files[${variantId}][]" multiple class="form-control pdf_upload"></div>
                        <label for="inputNumber" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-3"><input type="text" name="pdf_names[${variantId}][]" class="form-control"></div>
                        <div class="col-sm-2"><button type="button" class="btn btn-danger btn-sm float-end deletespec"><i class="bi bi-trash"></i></button></div>
                    </div>`;
                $parentTabPane.find('.brochures-container').append(spec);
            });

            // Delete Brochure Section dynamically
            $('body').on('click', '.deletespec', function() {
                $(this).closest('.row').remove();
            });
            // Function to add a new specification component within a tab

            $('body').on('click', '.deletespec,.deleteres,.deletaccess,.deleteCompt', function() {
                $(this).closest('.row').remove();
            });
            $('body').on('click', '.deleteimage', function() {
                $(this).closest('.col-md-3').remove();
            });
            $('#productmedia').change(function() {
                var file_data = $('#productmedia').prop('files')[0];
                var sizeKB = file_data.size / 1024;

                // Validate file size
                if (sizeKB > 2048) {
                    $('.pmsg').html(
                        '<div class="text-danger">The featured image may not be greater than 2048 kilobytes</div>'
                    );
                    $('#productmedia').val(''); // Clear the file input
                    return;
                }

                // Validate file type
                if (!file_data.name.match(/\.(jpg|jpeg|png|gif|svg)$/)) {
                    $('.pmsg').html(
                        '<div class="text-danger">The featured image must be a file of type: jpeg, png, jpg, gif, svg.</div>'
                    );
                    $('#productmedia').val(''); // Clear the file input
                    return;
                }

                // Clear previous error messages
                $('.pmsg').html('');

                var form_data = new FormData();
                form_data.append('FileInput', file_data);
                form_data.append('path', "images/product");
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
                            var cart = `<div class="col-sm-6 col-md-3">
                    <div class="card ">
                    <input type="hidden" name="images[]" value="` + response.filename + `">
                    <img src="` + response.url + `" class="card-img-top" alt="...">
                    <div class="card-body text-center ">
                      <button type="button" class="btn btn-danger btn-sm mt-3 deleteimage"><i class="bi bi-trash"></i></button>
                    </div>
                  </div>
                  </div>`;
                            $('.imageitem').before(cart);
                            $('#productmedia').val(
                                ''); // Clear the file input after successful upload
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
        });
        var editorsHight = 500;
        var editorimageuploadurl = "{{ route('imageuploader.imagesupload') }}";
        var csrftoken = "{{ csrf_token() }}";
    </script>

    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/fileuploader.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/editors.js"></script>

    <script type="text/javascript">
        $(document).on('keydown.autocomplete', '.autocomplete', function() {
            var txt = (this);
            $(this).autocomplete({
                source: "{{ route('product.getspecifications') }}",
                minLength: 2

            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/addvideo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var bimage;
            $('body').on('click', '.addblogimage', function() {
                bimage = $(this);
                $('#blogimagefile').click();
            });
            $('#blogimagefile').change(function() {
                var file_data = $('#blogimagefile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('FileInput', file_data);
                form_data.append('path', "images/product");
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
                        $('#blogimage')[0].reset();
                    },
                    error: function(response) {
                        $('#msg').html(response); // display error response from the server
                    }
                });
            });
            // Add Key Feature Section dynamically
            $('body').on('click', '.addblog', function() {
                var $parentTabPane = $(this).closest('.tab-pane');
                var variantId = $parentTabPane.find('input[name="v_id[]"]')
                    .val(); // Get the variant ID from the hidden input field

                var spec = `
                    <div class="row rm-content">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="inputTitle" class="col-form-label">Title</label>
                                        <input type="text" name="blogtitle[${variantId}][]" class="form-control" placeholder="Title">
                                        <label for="inputDescription" class="col-form-label">Description</label>
                                        <textarea class="form-control" name="blogdescription[${variantId}][]"></textarea>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card addblogimage mb-0">
                                            <input type="hidden" name="blogimage[${variantId}][]" class="hiddenblogimage">
                                            <img src="{{ asset('images/product/productDefault.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <button type="button" class="btn btn-primary btn-sm mt-3">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-danger btn-sm float-end deleteblogimage">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $parentTabPane.find('.key-f-container').append(spec);
            });


            // Delete Key Feature Section dynamically
            $('body').on('click', '.deleteblogimage', function() {
                $(this).closest('.rm-content').remove();
            });
            $('body').on('click', '.deletecomp', function() {
                $(this).closest('.delcompt').remove();
            });
            $('body').on('click', '.deletespecf', function() {
                $(this).closest('.specfrm').remove();
            });

            $('body').on('click', '.deletespecsheet', function() {
                $(this).closest('.col-sm-3 ').remove();
                /*var speccontent = ` <div class="col-sm-12 "><button type="button" class="btn btn-primary btn-sm float-end addspecsheet mt-3"><i class="bi bi-plus"></i> Add spece sheet</button></div>`;
                $('#specsheet').html(speccontent);*/
            });

            $('body').on('click', '.addspecimage', function() {
                bimage = $(this);
                $('#specificationimagefile').click();
            });
            $('body').on('click', '.deletespecimage', function() {
                bimage = $(this);
                $('.specificationimagecon').html('');
            });

            $('#specificationimagefile').change(function() {
                var file_data = $('#specificationimagefile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('FileInput', file_data);
                form_data.append('path', "images/product");
                form_data.append('type', "specificationImage");
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
                            var speccontent = `<div class="col-sm-3 ">
                    <div class="card" >
                    <input type="hidden" name="speceimage" value="` + response.filename + `">
                      <img class="" src="` + response.url + `" alt="Card image cap">
                      
                      <div class="card-footer text-center">
                        <button type="button" class="btn btn-danger btn-sm deletespecimage "><i class="bi bi-trash"></i> </button>
                      </div>
                    </div>
                  </div>`;
                            $('.specificationimagecon').html(speccontent);
                        } else {
                            if (typeof(response.errors.FileInput) != "undefined") {
                                $('.addspecsheet').after('<div class="text-danger">' + response
                                    .errors.FileInput
                                    .toString() + '</div>');
                            }

                        }
                        $('#specsheetfrm')[0].reset();
                    },
                    error: function(response) {
                        if (response.status == 422 && typeof(response.responseJSON.errors) !=
                            "undefined" && typeof(
                                response.responseJSON.errors.FileInput) != "undefined") {
                            $('.addspecsheet').after('<div class="text-danger">' + response
                                .responseJSON.errors.FileInput
                                .toString() + '</div>');
                        } else {
                            $('.addspecsheet').after('<div class="text-danger">' + response
                                .responseJSON.message +
                                '</div>');
                        }
                    }
                });
            });

        })

        $('#addfeaturedimage').click(function() {
            $('#featuredimage').click();
        });
        $('#featuredimage').change(function() {
            const file = this.files[0];
            var sizeKB = file.size / 1024;
            if (sizeKB > 2048) {
                $('.msg').html(
                    '<div class="text-danger">The featured image may not be greater than 2048 kilobytes</div>');
                return;
            } else if (!file.name.match(/\.(jpg|jpeg|png|gif|svg)$/)) {
                $('.msg').html(
                    '<div class="text-danger">The featured image must be a file of type: jpeg, png, jpg, gif.</div>'
                );
                return;
            } else {
                $('.msg').html('');
            }
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#featuredimagepreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>



    <script>
        $(document).ready(function() {
            $("#addInputButton").click(function() {
                // Clone the last input container and increment the ID
                var lastContainer = $(".input-container:last");
                var containerId = lastContainer.attr('id');
                var idParts = containerId.split('-');
                var newId = parseInt(idParts[2]) + 1;

                var newInputContainer = lastContainer.clone();
                newInputContainer.attr('id', 'input-container-' + newId);

                // Clear the input value in the cloned container
                newInputContainer.find('input').val('');

                // Append the cloned container to the input-container div
                $("#input-container").append(newInputContainer);

                // Enable the remove button for the new input container
                newInputContainer.find('.removeInputButton').prop('disabled', false);
            });

            // Use event delegation to handle dynamically added "Remove" buttons
            $("#input-container").on("click", ".removeInputButton", function() {
                // Remove the parent div of the clicked "Remove" button
                $(this).closest('.input-container').remove();

                // If there is only one input field left, disable its "Remove" button
                if ($('.input-container').length === 1) {
                    $('.removeInputButton').prop('disabled', true);
                }
            });
        });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var itemId = button.data('id'); // Extract info from data-* attributes

                // Update the form action
                var form = $('#deleteForm');
                var action = '{{ route('product.destroyComponent', ':id') }}';
                action = action.replace(':id', itemId);
                form.attr('action', action);
            });
            $('#confirmDeleteModalPDFDelete').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget); // Button that triggered the modal
                var itemId = button.data('id'); // Extract info from data-* attributes
                // Update the form action
                var form = $('#deleteFormPDF');
                var action = '{{ route('product.destoryBrochures', ':id') }}';
                action = action.replace(':id', itemId);
                form.attr('action', action);
            });
            $('#confirmDeleteModalComponentDelete').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget); // Button that triggered the modal
                var itemId = button.data('id'); // Extract info from data-* attributes
                // Update the form action
                var form = $('#deleteFormComponent');
                var action = '{{ route('product.destroyComponent', ':id') }}';
                action = action.replace(':id', itemId);
                form.attr('action', action);
            });
            $('#confirmDeleteModalKeyFeatureSectionDelete').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget); // Button that triggered the modal
                var itemId = button.data('id'); // Extract info from data-* attributes
                // Update the form action
                var form = $('#deleteFormKeyFeatureSection');
                var action = '{{ route('product.destoryKeyFeatureSection', ':id') }}';
                action = action.replace(':id', itemId);
                form.attr('action', action);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to add a new tab
            function addTab(tabId, tabTitle, variantId, isActive) {
                // Append tab link
                var activeClass = isActive ? ' active' : '';
                var tabLink = '<li class="nav-item"><a class="nav-link' + activeClass +
                    '" data-bs-toggle="tab" href="#' + tabId + '" data-variant-id="' + variantId + '">' + tabTitle +
                    '</a></li>';
                $('#tabList').append(tabLink);

                // Append tab content with multiple input boxes
                var activePaneClass = isActive ? ' show active' : '';
                var tabContent = `
                    <div class="tab-pane fade ${activePaneClass}" id="${tabId}">
                        <input type="hidden" name="v_id[]" value="${variantId}">
                        <h3 class="card-title" style="text-align:center; text-decoration: underline;">${tabTitle} Variant Content</h3>
                        <div class="row mb-3">
                            
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="text-align:center;"> Product Component CSV</h4>
                                        <div class="container mt-5">
                                            <div class="form-group">
                                                <label for="csv_file">Choose csv file to upload components</label>
                                                <input type="file" class="form-control" name="csv_file[${variantId}][]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                <div class="row bimagec sectionunsortable">
                                    <div class="col-sm-12 mb-3 d-flex-center">
                                        <h4 class="card-title mb-0">Product Component</h4>
                                        <button type="button" class="btn btn-primary btn-sm addspeccomp"><i class="bi bi-plus"></i> Add Section</button>
                                    </div>


                                </div>
                                <div class="row comp-container" >
                                    
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col-sm-12" id="sectionSortable">
                                     <div class="col-sm-12 mb-3 d-flex-center bimagec sectionunsortable">
                                        <div><h4 class="card-title mb-0">Key Feature Tile Section </h4> <small>Image * (625 x 338 px)</small> </div>
                                        <button type="button" class="btn btn-primary btn-sm addblog"><i class="bi bi-plus"></i> Add Section</button>
                                    </div>
                                    <div class="row key-f-container rm-content">
                                        <div class="col-md-12">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label for="inputTitle" class="col-form-label">Title</label>
                                                        <input type="text" name="blogtitle[${variantId}][]" class="form-control" placeholder="Title">
                                                        <label for="inputDescription" class="col-form-label">Description</label>
                                                        <textarea class="form-control" name="blogdescription[${variantId}][]"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="card addblogimage mb-0">
                                                            <input type="hidden" name="blogimage[${variantId}][]" class="hiddenblogimage">
                                                            <img src="{{ asset('images/product/productDefault.png') }}" class="card-img-top" alt="...">
                                                            <div class="card-body text-center">
                                                                <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-danger btn-sm float-end deleteblogimage"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row brochures-container">
                                                <div class="col-sm-12">
                                                   <div class="col-sm-12 mb-3 d-flex-center bimagec sectionunsortable">
                                                        <h4 class="card-title mb-0">Upload Brochures</h4>
                                                        <button type="button" style="margin-bottom: 5px;" class="btn btn-primary btn-sm float-end addspecBr mt-3"><i class="bi bi-plus"></i> Add Brochures</button></div>
                                                    </div>
                                                    
                                                    <div class="row mt-2 brochures-section">
                                                        <label for="inputNumber" class="col-sm-2 col-form-label">Upload PDF</label>
                                                        <div class="col-sm-3">
                                                            <input type="file" name="pdf_files[${variantId}][]" multiple class="form-control pdf_upload">
                                                        </div>
                                                        <label for="inputNumber" class="col-sm-2 col-form-label">Title</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="pdf_names[${variantId}][]" class="form-control">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="button" class="btn btn-danger btn-sm float-end deletespec"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div><br>
                                            <div class="row brochures-container-view">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Key Feature Desc</label>
                                <div class="col-sm-10 key-feature-container-view">
                                    
                                </div>
                            </div>
                        </div>`;
                $('#tabContent').append(tabContent);
            }

            var dynamicFieldsCache = {};
            // Attach click event handler to tab links
            $(document).on('click', '.nav-link', function() {
                // Retrieve variantId associated with the clicked tab
                var variantId = $(this).data('variant-id');
                // Call fetchProductComponentData with productId and variantId
                var productId = $('input[name="id"]').val();
                // Fetch and display data for the selected tab
                fetchTabData(productId, variantId);
            });

            function fetchTabData(productId, variantId) {
                // Check if the data for the current tab is already in the cache
                if (dynamicFieldsCache.hasOwnProperty(variantId)) {
                    // Restore cached data for the current tab
                    restoreCachedFields(variantId);
                } else {
                    // Fetch data for the current tab via AJAX requests
                    fetchProductComponentData(productId, variantId);
                    fetchKeyFeatureSectionData(productId, variantId);
                    fetchBrochuresData(productId, variantId);
                    fetchKeyFeatureDescData(productId, variantId);
                }
            }

            function cacheDynamicFields(variantId) {
                // Cache the HTML content of dynamically added fields within the current tab
                dynamicFieldsCache[variantId] = {};
                $('#tab' + variantId + ' .comp-container, #tab' + variantId + ' .key-f-container, #tab' +
                    variantId +
                    ' .brochures-container-view, #tab' + variantId + ' .key-feature-container-view').each(
                    function() {
                        dynamicFieldsCache[variantId][$(this).attr('class')] = $(this).html();
                    });
            }

            function restoreCachedFields(variantId) {
                // Restore the cached data of dynamically added fields within the current tab
                if (dynamicFieldsCache.hasOwnProperty(variantId)) {
                    $.each(dynamicFieldsCache[variantId], function(className, cachedContent) {
                        $('#tab' + variantId + ' .' + className).html(cachedContent);
                    });
                }
            }
            var selectedVariantId;

            // Your existing handleDropdownChange function
            function handleDropdownChange() {
                var selectedOptions = $('#variants').val(); // Get selected variant IDs
                $('#tabList').empty(); // Clear existing tabs
                $('#tabContent').empty(); // Clear existing tab content
                if (selectedOptions) {
                    var productId = $('input[name="id"]').val();
                    $.each(selectedOptions, function(index, value) {
                        var variantId = value;
                        var optionText = $('#variants option[value="' + value + '"]').text();
                        var isActive = index === 0; // Set the first tab as active
                        addTab('tab' + value, optionText, variantId, isActive);
                        if (isActive) {
                            selectedVariantId =
                                variantId; // Store the selected variant ID only when page loads
                        }
                    });
                    // Fetch product component data for the selected variant on page load
                    fetchProductComponentData(productId, selectedVariantId);
                    fetchKeyFeatureSectionData(productId, selectedVariantId);
                    fetchBrochuresData(productId, selectedVariantId);
                    fetchKeyFeatureDescData(productId, selectedVariantId);
                }
            }

            function fetchProductComponentData(productId, variantId) {
                $.ajax({
                    url: "{{ route('fetchData') }}",
                    method: 'GET',
                    data: {
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function(response) {
                        // Update the component fields with the fetched data
                        var data = '';
                        cacheDynamicFields(variantId); // Cache the data after successful AJAX request
                        restoreCachedFields(variantId);
                        if (response.length === 0) {
                            //tabData[variantId] = {};
                            data = getEmptyComponentData(variantId);
                        } else {
                            $.each(response, function(index) {
                                data += getComponentDataHtml(variantId, response[index]);
                            });
                        }
                        $('#tab' + variantId + ' .comp-container').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function fetchKeyFeatureSectionData(productId, variantId) {
                $.ajax({
                    url: "{{ route('fetchKeyFeatureSectionData') }}",
                    method: 'GET',
                    data: {
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function(response) {
                        // Update the component fields with the fetched data
                        var data = '';
                        cacheDynamicFields(variantId); // Cache the data after successful AJAX request
                        restoreCachedFields(variantId);
                        if (response.length === 0) {
                            data = getEmptyKeyFeatureSectionData(variantId);
                        } else {
                            $.each(response, function(index) {
                                data += getKeyFeatureSectionDataHtml(variantId, response[
                                    index]);
                            });
                        }
                        $('#tab' + variantId + ' .key-f-container').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function fetchBrochuresData(productId, variantId) {
                $.ajax({
                    url: "{{ route('fetchBrochuresData') }}",
                    method: 'GET',
                    data: {
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function(response) {
                        // Update the component fields with the fetched data
                        var data = '';
                        cacheDynamicFields(variantId); // Cache the data after successful AJAX request
                        restoreCachedFields(variantId);
                        if (response.length === 0) {
                            data = getEmptyBrochureData();
                        } else {
                            $.each(response, function(index) {
                                data += getBrochureDataHtml(variantId, response[index]);
                            });
                        }
                        $('#tab' + variantId + ' .brochures-container-view').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function fetchKeyFeatureDescData(productId, variantId) {
                $.ajax({
                    url: "{{ route('fetchKeyFeatureDescData') }}",
                    method: 'GET',
                    data: {
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function(response) {
                        // Update the component fields with the fetched data
                        var data = '';
                        cacheDynamicFields(variantId); // Cache the data after successful AJAX request
                        restoreCachedFields(variantId);
                        if (response.length === 0) {
                            data = getEmptyKeyFeatureDescData(variantId);
                        } else {
                            $.each(response, function(index) {
                                data += getKeyFeatureDescDataHtml(variantId, response[index]);
                            });
                        }
                        $('#tab' + variantId + ' .key-feature-container-view').html(data);

                        // Initialize TinyMCE after HTML content is inserted
                        initializeTinyMCE(variantId);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to initialize TinyMCE on dynamically generated textareas
            function initializeTinyMCE(variantId) {
                $('#tab' + variantId + ' .key-feature-container-view textarea').each(function() {
                    let textareaId = this.id;
                    console.log("Initializing TinyMCE for textarea: ", textareaId); // Debug log
                    if (!tinymce.get(textareaId)) {
                        tinymce.init({
                            selector: '#' + textareaId,
                            plugins: 'advlist autolink lists link image charmap print preview anchor textcolor colorpicker fontselect',
                            toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor fontselect | link image | fontsizeselect',
                            menubar: false,
                            fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
                            font_formats: 'Arial=arial,helvetica,sans-serif;Times New Roman=times new roman,times,serif;Verdana=verdana,geneva,sans-serif;Tahoma=tahoma,arial,helvetica,sans-serif;Georgia=georgia,times new roman,times,serif;Courier New=courier new,courier,monospace',
                        });
                    }
                });
            }


            // Trigger change event on load to show all selected tabs
            handleDropdownChange();

            // Handle dropdown change event
            $('#variants').change(handleDropdownChange);

            // Add new component
            $(document).on('click', '.addspeccomp', function() {
                var $parentTabPane = $(this).closest('.tab-pane');
                var variantId = $parentTabPane.find('input[name="v_id[]"]')
                    .val(); // Get the variant ID from the hidden input field
                var comp = `
                <div class="card delcompt">
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label for="inputType" class="col-form-label">Component Type</label>
                                <input type="text" name="component_type[${variantId}][]" class="form-control autocomplete">
                            </div>
                            <div class="col-sm-5">
                                <label for="inputName" class="col-form-label">Component Name</label>
                                <input type="text" name="component_name[${variantId}][]" class="form-control autocomplete">
                            </div>
                            <div class="col-sm-5">
                                <label for="inputValue" class="col-form-label">Component Value</label>
                                <input type="text" name="component_specification[${variantId}][]" class="form-control autocomplete">
                            </div>
                            <div class="col-sm-1" style="margin-top:40px;">
                                <button type="button" class="btn btn-danger btn-sm float-end deletecomp"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>`;
                $parentTabPane.find('.comp-container').append(comp);
            });
        });

        function getEmptyComponentData(variantId) {
            return `
            <div class="card delcompt">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="inputType" class="col-form-label">Component Type</label>
                            <input type="text" name="component_type[${variantId}][]" class="form-control autocomplete">
                        </div>
                        <div class="col-sm-5">
                            <label for="inputName" class="col-form-label">Component Name</label>
                            <input type="text" name="component_name[${variantId}][]" class="form-control autocomplete">
                        </div>
                        <div class="col-sm-5">
                            <label for="inputValue" class="col-form-label">Component Value</label>
                            <input type="text" name="component_specification[${variantId}][]" class="form-control autocomplete">
                        </div>
                        <div class="col-sm-1" style="margin-top:40px;">
                            <button type="button" class="btn btn-danger btn-sm float-end deletecomp"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        function getComponentDataHtml(variantId, data) {
            let componentNameValue = data.component_name !== null ? data.component_name : '';
            return `
            <div class="card delcompt">
                <div class="card-body">
                    <div class="row mt-2">
                        <input type="hidden" name="component_id[${variantId}][]" value="${data.id}">
                        <div class="col-sm-6">
                            <label for="inputType" class="col-form-label">Component Type</label>
                            <input type="text" name="component_type[${variantId}][]" class="form-control autocomplete" value="${data.component_type}">
                        </div>
                        <div class="col-sm-5">
                            <label for="inputName" class="col-form-label">Component Name</label>
                            <input type="text" name="component_name[${variantId}][]" class="form-control autocomplete" value="${componentNameValue}">
                        </div>
                        <div class="col-sm-5">
                            <label for="inputValue" class="col-form-label">Component Value</label>
                            <input type="text" name="component_specification[${variantId}][]" class="form-control autocomplete" value="${data.component_specification}">
                        </div>
                        <div class="col-sm-1" style="margin-top:40px;">
                            <button type="button" class="btn btn-danger btn-sm float-end deletecomp delete-component" name="deletecomponent_id[${variantId}][]" value="${data.id}" data-toggle="modal" data-target="#confirmDeleteModalComponentDelete" data-id="${data.id}"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        function getEmptyKeyFeatureSectionData(variantId) {
            return `
                <div class="row rm-content">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="inputTitle" class="col-form-label">Title</label>
                                    <input type="text" name="blogtitle[${variantId}][]" class="form-control" placeholder="Title">
                                    <label for="inputDescription" class="col-form-label">Description</label>
                                    <textarea class="form-control" name="blogdescription[${variantId}][]"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card addblogimage mb-0">
                                        <input type="hidden" name="blogimage[${variantId}][]" class="hiddenblogimage">
                                        <img src="{{ asset('images/product/productDefault.png') }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary btn-sm mt-3">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger btn-sm float-end deleteblogimage">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        }

        function getKeyFeatureSectionDataHtml(variantId, data) {
            return `
                <div class="row rm-content">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <input type="hidden" name="keyFeatureSec_id[${variantId}][]" value="${data.id}">
                                <div class="col-sm-8">
                                    <label for="inputTitle" class="col-form-label">Title</label>
                                    <input type="text" name="blogtitle[${variantId}][]" class="form-control" placeholder="Title" value="${data.title}">
                                    <label for="inputDescription" class="col-form-label">Description</label>
                                    <textarea class="form-control" name="blogdescription[${variantId}][]">${data.description}</textarea>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card addblogimage mb-0">
                                        <input type="hidden" name="blogimage[${variantId}][]" value="${data.image}" class="hiddenblogimage">
                                        <img src="{{ asset('images/product/') }}/${data.image}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary btn-sm mt-3">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger btn-sm float-end deleteblogimage" data-toggle="modal" data-target="#confirmDeleteModalKeyFeatureSectionDelete" data-id="${data.id}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        }

        function getEmptyBrochureData() {
            return `
                <div class="col-sm-3">
                    <div class="card">
                        <embed src="" width="50px" height="70px" />
                        <div class="card-body mt-3 text-center">
                            <a href="" class="card-link mt-3" target="_blank"></a>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-danger btn-sm deletespecsheet" data-toggle="modal" data-target="#confirmDeleteModalPDFDelete" data-id=""><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>`;
        }

        function getBrochureDataHtml(variantId, data) {
            return `
                <div class="col-sm-3">
                    <div class="card">
                        <input type="hidden" name="brochures_id[${variantId}][]" value="${data.id}">
                        <embed src="{{ asset('specesheet/') }}/${data.value}"  width="50px" height="70px" />
                        <div class="card-body mt-3 text-center">
                            <a href="{{ asset('specesheet/') }}/${data.value}" class="card-link mt-3" target="_blank">${data.value}</a>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-danger btn-sm deletespecsheet" data-toggle="modal" data-target="#confirmDeleteModalPDFDelete" data-id="${data.id}"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>`;
        }

        // Function to generate empty textarea HTML content
        function getEmptyKeyFeatureDescData(variantId) {
            // Generate unique textarea ID
            let textareaId = `content${variantId}`;

            // Generate the HTML content for empty textarea
            let htmlContent =
                `
            
                <textarea name="key_features[${variantId}][]" class="form-control content" id="${textareaId}"></textarea>`;

            // Return the HTML content
            return htmlContent;
        }


        function getKeyFeatureDescDataHtml(variantId, data) {
            // Generate unique textarea ID
            let textareaId = `content${variantId}`;

            // Generate the HTML content
            let htmlContent =
                `
                <input type="hidden" name="key_featuresID[${variantId}][]" value="${data.variant_id}">
                <input type="hidden" name="keyfeatureid[${variantId}]" value="${data.id}">
                <textarea name="key_features[${variantId}][]" class="form-control content" id="${textareaId}" style="height: 127px;">${data.description}</textarea>`;

            // Return the HTML content
            return htmlContent;
        }
    </script>

    <script>
        function validateFileSize() {
            const maxFileSize = 50 * 1024 * 1024; // 50 MB in bytes
            const fileInputs = document.getElementsByClassName('pdf_upload');

            for (let i = 0; i < fileInputs.length; i++) {
                const files = fileInputs[i].files;

                for (let j = 0; j < files.length; j++) {
                    if (files[j].size > maxFileSize) {
                        alert('File size exceeds the maximum limit of 50 MB.');
                        return false;
                    }
                }
            }
            return true;
        }
    </script>
    <script>
        function updateCharCount() {
            var metaTitleInput = document.getElementById('meta_title');
            var charCount = document.getElementById('charCount');
            var currentLength = metaTitleInput.value.length;
            charCount.textContent = currentLength + '/60 characters';
        }
        
        function checkKeywords() {
            var metaKeywordsInput = document.getElementById('meta_keywords');
            var keywordCount = document.getElementById('keywordCount');
            var keywordError = document.getElementById('keywordError');

            var keywords = metaKeywordsInput.value.split(',');
            var numKeywords = keywords.filter(keyword => keyword.trim() !== "").length;

            if (numKeywords > 10) {
                keywordError.style.display = 'block';
                metaKeywordsInput.value = keywords.slice(0, 10).join(',');
            } else {
                keywordError.style.display = 'none';
            }

            keywordCount.textContent = numKeywords + '/10 keywords';
        }


        function checkWordCount() {
        var metaDescriptionInput = document.getElementById('meta_description');
        var wordCount = document.getElementById('wordCount');
        var wordError = document.getElementById('wordError');

        var words = metaDescriptionInput.value.trim().split(/\s+/);
        var numWords = words.length;

        if (numWords > 180) {
            wordError.style.display = 'block';
            // Limit the text to 180 words
            metaDescriptionInput.value = words.slice(0, 180).join(' ');
            numWords = 180;
        } else {
            wordError.style.display = 'none';
        }

        wordCount.textContent = numWords + '/180 words';
    }

        // Initialize character count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount();
            checkKeywords();
            checkWordCount();
        });
    </script>
@endsection

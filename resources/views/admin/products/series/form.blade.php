@extends('admin.layouts.app')
@section('styles')
    <style type="text/css">
        .banner_img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1>{{ !empty($series->id) ? 'Edit' : 'Create' }} Product Series</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('productSeries.index') }}">Product Series</a></li>
                <li class="breadcrumb-item active">{{ !empty($series->id) ? 'Edit' : 'Create' }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @include('admin.shared.displaymsg')

                        <h5 class="card-title">Product series</h5>

                        <!-- Horizontal Form -->
                        <form method="POST" action="{{ route('productSeries.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if (!empty($series->id))
                                <input type="hidden" name="id" value="{{ $series->id }}">
                            @endif
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Name <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                        class="form-control {{ $errors->has('name') ? 'border-danger' : '' }} "
                                        id="inputText" value="{{ old('name', isset($series->name) ? $series->name : '') }}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Select Category <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    @if (!empty($series->id))
                                        <input type="hidden" name="id" value="{{ $series->id }}">
                                    @endif
                                    <select class="form-select" name="category_id">
                                        <option disabled>Select One...</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $value->id }}"
                                                @if (!empty($series->category_id)) {{ $series->category_id == $value->id ? 'selected="selected"' : '' }} @endif />
                                            {{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="text-danger">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form><!-- End Horizontal Form -->

                </div>
            </div>



        </div>


        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
    <script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
    <script type="text/javascript">
        var editorsHight = 300;
        var editorimageuploadurl = "{{ route('imageuploader.imagesupload') }}";
        var csrftoken = $('input[name=_token]').val();
        $(document).ready(function() {
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
                } else if (!file.name.match(/\.(jpg|jpeg|png|gif)$/)) {
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
        });
    </script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/editors.js"></script>
@endsection

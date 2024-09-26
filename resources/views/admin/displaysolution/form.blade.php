@extends('admin.layouts.app')
@section('styles')
    <!-- <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
                      <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->
    <style type="text/css">
        .tox-promotion,
        .tox-statusbar__branding {
            display: none;
        }

        .hidden {
            display: none;
        }

        .content {
            display: none;
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
    <div class="newsroomtitle">
        <h1>Display Solution</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Display Solution</li>
            </ol>
        </nav>
    </div><!-- End newsroom Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">




                <div class="card">
                    <div class="card-body">
                        @include('admin.shared.displaymsg')

                        <form method="POST" action="{{ route('displaysolution.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h5 class="card-title">
                                {{ isset($displaysolution->title) ? $displaysolution->title : 'New Display Solution' }}</h5>

                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Select Menu <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    @if (!empty($displaysolution->id))
                                        <input type="hidden" name="id" value="{{ $displaysolution->id }}">
                                    @endif
                                    <select class="form-select" name="menu_id">
                                        <option disabled>Select One...</option>
                                        @foreach ($menus as $key => $value)
                                            <option value="{{ $value->id }}"
                                                @if (!empty($displaysolution->menu_id)) {{ $displaysolution->menu_id == $value->id ? 'selected="selected"' : '' }} @endif />
                                            {{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('menu_id'))
                                        <div class="text-danger">{{ $errors->first('menu_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta title</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ old('meta_title', isset($displaysolution->meta_title) ? $displaysolution->meta_title : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta keywords</label>
                                <div class="col-md-10">
                                    <input type="text" name="meta_keywords" class="form-control"
                                        value="{{ old('meta_keywords', isset($displaysolution->meta_keywords) ? $displaysolution->meta_keywords : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Meta description</label>
                                <div class="col-md-10">
                                    <textarea name="meta_description" class="form-control">{{ old('meta_description', isset($displaysolution->meta_description) ? $displaysolution->meta_description : '') }}</textarea>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Heading <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="short_description" class="form-control {{ $errors->has('short_description') ? 'border-danger' : '' }} "
                                        id="">{{ old('short_description', isset($displaysolution->short_description) ? $displaysolution->short_description : '') }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Select Design <span
                                        style="color: red; font-size: small;">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-select" name="design" id="dropdown">
                                        <option disabled>Select One...</option>
                                        <option value="basic"
                                            @if (isset($displaysolution->design)) {{ $displaysolution->design == 'basic' ? 'selected' : '' }} @endif>
                                            Basic Design</option>
                                        <option value="standard"
                                            @if (isset($displaysolution->design)) {{ $displaysolution->design == 'standard' ? 'selected' : '' }} @endif>
                                            Standard Design</option>
                                        <option value="alternate"
                                            @if (isset($displaysolution->design)) {{ $displaysolution->design == 'alternate' ? 'selected' : '' }} @endif>
                                            Alternate Design</option>
                                    </select>

                                    @if ($errors->has('design'))
                                        <div class="text-danger">{{ $errors->first('design') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Display at Homepage</label>
                                <div class="col-md-10">
                                    <label>
                                        <input type="radio" name="display_at_homepage" value="1"
                                            {{ !isset($displaysolution->display_at_homepage) || $displaysolution->display_at_homepage == 1 ? 'checked' : '' }}>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="display_at_homepage" value="0"
                                            {{ isset($displaysolution->display_at_homepage) && $displaysolution->display_at_homepage == 0 ? 'checked' : '' }}>
                                        No
                                    </label>
                                    <div id="additionalInput" class="row mb-3 hidden">
                                        <label for="additionalText" class="col-md-2 col-form-label">Display Order</label>
                                        <div class="col-md-3">
                                            <input type="number" name="sort_order" class="form-control"
                                                value="{{ isset($displaysolution->sort_order) ? $displaysolution->sort_order : '' }}">
                                        </div>
                                        <label for="additionalText" class="col-md-2 col-form-label">Short Desc <span
                                                style="color: red; font-size: small;">*</span></label>
                                        <div class="col-md-4">
                                            <textarea name="short_desc_home" class="form-control">{{ isset($displaysolution->short_desc_home) ? $displaysolution->short_desc_home : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputTextSolutions" class="col-md-2 col-form-label">Display at Solution page
                                </label>
                                <div class="col-md-10">
                                    <label>
                                        <input type="radio" name="at_solutions" value="1"
                                            {{ !isset($displaysolution->at_solutions) || $displaysolution->at_solutions == 1 ? 'checked' : '' }}>
                                        Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="at_solutions" value="0"
                                            {{ isset($displaysolution->at_solutions) && $displaysolution->at_solutions == 0 ? 'checked' : '' }}>
                                        No
                                    </label>
                                    <div id="additionalInputSolution" class="row mb-3 hidden">
                                        <label for="additionalTextSolution" class="col-md-2 col-form-label">Display
                                            Order</label>
                                        <div class="col-md-3">
                                            <input type="number" name="order_display" class="form-control"
                                                value="{{ isset($displaysolution->order_display) ? $displaysolution->order_display : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputText" class="col-md-2 col-form-label">Content</label>
                                {{-- <div class="col-md-10">
                                    <textarea name="content" id="content" class="content">{{ old('content', isset($displaysolution->content) ? $displaysolution->content : '') }}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    @endif
                                </div> --}}
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control {{ $errors->has('content') ? 'border-danger' : '' }} " id="">{{ old('content', isset($displaysolution->content) ? $displaysolution->content : '') }}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="text-danger">{{ $errors->first('content') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Gallery Image <br> <small
                                        style="font-size;11px;">(600x446) <span
                                            style="color: red; font-size: small;">*</span></small></label>
                                <div class="col-sm-4">
                                    <div class="card ">

                                        <img src="{{ asset(isset($displaysolution->image) ? 'images/' . $displaysolution->image : 'images/inds1.jpg') }}"
                                            class="card-img-top" alt="..." id="bannerimagepreview">
                                        <div class="card-body text-center ">
                                            <button type="button" class="btn btn-primary btn-sm mt-3 "
                                                id="addbannerimage"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </div>
                                    @if ($errors->has('bannerimage'))
                                        <div class="text-danger">{{ $errors->first('bannerimage') }}</div>
                                    @endif
                                    <div class="msg"></div>
                                </div>

                            </div>
                            <input type="file" name="image" accept="image" id="bannerimage" class="d-none">
                            <div id="content1" class="content" style="display: none;">
                                <hr>
                                <h5 class="card-title">Banner Details</h5>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-md-2 col-form-label">Heading</label>
                                    <div class="col-md-10">
                                        <input type="text" name="banner_title" class="form-control"
                                            value="{{ old('banner_title', isset($displaysolution->banner_title) ? $displaysolution->banner_title : '') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea name="banner_short_description"
                                            class="form-control {{ $errors->has('banner_short_description') ? 'border-danger' : '' }} " id="">{{ old('banner_short_description', isset($displaysolution->banner_short_description) ? $displaysolution->banner_short_description : '') }}</textarea>
                                        @if ($errors->has('banner_short_description'))
                                            <div class="text-danger">{{ $errors->first('banner_short_description') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image (500 x 469)<br>
                                        <!--<small style="font-size;11px;">(1920x640)</small>--></label>
                                    <div class="col-sm-10">
                                        <div class="card ">

                                            <img src="{{ asset(isset($displaysolution->bannerimage) ? 'images/' . $displaysolution->bannerimage : 'images/computerbanner.jpg') }}"
                                                class="banner-img" alt="..." id="bannerimagepreview1">
                                            <div class="card-body text-center ">
                                                <button type="button" class="btn btn-primary btn-sm mt-3 "
                                                    id="addbannerimage1"><i class="bi bi-pencil"></i></button>
                                            </div>
                                        </div>
                                        @if ($errors->has('bannerimage1'))
                                            <div class="text-danger">
                                                {{ str_replace('bannerimage1', 'banner image', $errors->first('bannerimage1')) }}
                                            </div>
                                        @endif
                                        <div class="msg"></div>
                                    </div>

                                </div>
                                <input type="file" name="bannerimage" id="bannerimage1" class="d-none"
                                    accept="image/png, image/jpeg, image/jpg, image/gif">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Industry Content</label>
                                    <div class="col-sm-10" id="sectionSortable">
                                        <div class="row bimagec sectionunsortable">
                                            <div class="col-sm-12 mb-3"><button type="button"
                                                    class="btn btn-primary btn-sm float-end addblog"><i
                                                        class="bi bi-plus"></i> Add Section</button></div>
                                        </div>
                                        @if (isset($displaysolution) && $displaysolution->SolutionDetail->isNotEmpty())
                                            @foreach ($displaysolution->SolutionDetail as $SolutionDetail)
                                                <div class="remove-section">
                                                    <div class="col-sm-12">
                                                        <div class="card p-3">
                                                            <div class="row ">
                                                                <div class="col-sm-8">
                                                                    <label for="inputEmail3"
                                                                        class="col-form-label">Title</label>
                                                                    <input type="text" name="ititle[]"
                                                                        class="form-control" placeholder="Title"
                                                                        value="{{ $SolutionDetail->heading }}">

                                                                    <label for="inputEmail3"
                                                                        class="col-form-label">Content</label>
                                                                    <textarea class="form-control" name="icontent[]">{{ $SolutionDetail->content }}</textarea>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <div class="card addblogimage mb-0">
                                                                        <input type="hidden" name="iimage[]"
                                                                            value="{{ $SolutionDetail->image }}">
                                                                        <img src="{{ asset('images/' . $SolutionDetail->image) }}"
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
                                                                <label for="inputEmail3"
                                                                    class="col-form-label">Title</label>
                                                                <input type="text" name="ititle[]"
                                                                    class="form-control" placeholder="Title"
                                                                    value="">

                                                                <label for="inputEmail3"
                                                                    class="col-form-label">Content</label>
                                                                <textarea class="form-control" name="icontent[]"></textarea>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="card addblogimage mb-0">
                                                                    <input type="hidden" name="iimage[]">
                                                                    <img src="" class="card-img-top"
                                                                        alt="...">
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
                                if (isset($displaysolution)) {
                                    $banner_section = json_decode($displaysolution->banner_section, true);
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
                            <div class="row mb-3">
                                <div class="row bannersectionimagec sectionunsortable">
                                    <div class="col-sm-12 mb-3 d-flex-center">
                                        <h4 class="card-title mb-0">Grid Section Content</h4>
                                        <button type="button" class="btn btn-primary btn-sm addbannersection"><i
                                                class="bi bi-plus"></i>
                                            Add Section</button>
                                    </div>
                                </div>
                                <?php
                                if (isset($displaysolution)) {
                                    $grid_section = json_decode($displaysolution->grid_section, true);
                                }
                                
                                ?>
                                @if (isset($grid_section))
                                    @foreach ($grid_section as $index => $value)
                                        <div class="remove-section">
                                            <div class="col-sm-12">
                                                <div class="card p-3">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label for="gtitle{{ $index }}"
                                                                class="col-form-label">Title</label>
                                                            <input type="text" id="gtitle{{ $index }}"
                                                                name="gtitle[]" class="form-control" placeholder="Title"
                                                                value="{{ $value['gtitle'] }}">

                                                            <label for="gcontent{{ $index }}"
                                                                class="col-form-label">Content</label>
                                                            <textarea id="gcontent{{ $index }}" class="form-control" name="gcontent[]">{{ $value['gcontent'] }}</textarea>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="card addbannersectionimage mb-0">
                                                                <input type="hidden" name="gimage[]"
                                                                    value="{{ $value['gimage'] }}">
                                                                <img src="{{ asset(isset($value['gimage']) ? 'images/' . $value['gimage'] : 'images/computerbanner.jpg') }}"
                                                                    class="banner-img bannersectionimagepreview" alt="...">
                                                                <div class="card-body text-center">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-sm mt-3"><i
                                                                            class="bi bi-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm float-end deletebannersectionimage"><i
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
                                                        <label for="gtitle" class="col-form-label">Title</label>
                                                        <input type="text" id="gtitle" name="gtitle[]"
                                                            class="form-control" placeholder="Title" value="">

                                                        <label for="gcontent" class="col-form-label">Content</label>
                                                        <textarea id="gcontent" class="form-control" name="gcontent[]"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="card addbannersectionimage mb-0">
                                                            <input type="hidden" name="gimage[]">
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
                                                            class="btn btn-danger btn-sm float-end deletebannersectionimage"><i
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
        <input type="file" name="media" id="blogimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="bannerimage" class="d-none">
        <input type="file" name="bimage[]" id="bannerimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
    <form id="bannersectionimage" class="d-none">
        <input type="file" name="bimage[]" id="bannersectionimagefile" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
@endsection
@section('scripts')
    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
                    <script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
                    $('.msg').html('<div class="text-danger">file size should less then 2MB.</div>');
                    return;
                } else if (!file.name.match(/\.(jpg|jpeg|png|gif)$/)) {
                    $('.msg').html('<div class="text-danger">this is not an image.</div>');
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

            $('#addbannerimage1').click(function() {
                $('#bannerimage1').click();
            });
            $('#bannerimage1').change(function() {
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
                        $('#bannerimagepreview1').attr('src', event.target.result);
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="display_at_homepage"]');
            const additionalInput = document.getElementById('additionalInput');

            const toggleAdditionalInput = () => {
                const checkedValue = document.querySelector('input[name="display_at_homepage"]:checked').value;
                if (checkedValue === '1') {
                    additionalInput.classList.remove('hidden');
                } else {
                    additionalInput.classList.add('hidden');
                }
            };

            radioButtons.forEach(radio => {
                radio.addEventListener('change', toggleAdditionalInput);
            });

            // Initial check
            toggleAdditionalInput();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('dropdown');
            const contents = document.querySelectorAll('.content');

            const toggleContent = () => {
                const value = dropdown.value;
                contents.forEach(content => {
                    content.style.display = 'none';
                });

                if (value === 'standard') {
                    document.getElementById('content1').style.display = 'block';
                }
            };

            dropdown.addEventListener('change', toggleContent);

            // Initial check on page load
            toggleContent();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="at_solutions"]');
            const additionalInputSolution = document.getElementById('additionalInputSolution');

            const toggleAdditionalInputSolution = () => {
                const checkedValue = document.querySelector('input[name="at_solutions"]:checked').value;
                if (checkedValue === '1') {
                    additionalInputSolution.classList.remove('hidden');
                } else {
                    additionalInputSolution.classList.add('hidden');
                }
            };

            radioButtons.forEach(radio => {
                radio.addEventListener('change', toggleAdditionalInputSolution);
            });

            // Initial check
            toggleAdditionalInputSolution();
        });
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.addbannersection').click(function() {
                var spec = `<div class="remove-section">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="inputEmail3" class="col-form-label">title</label>
                                    <input type="text" name="gtitle[]" class="form-control" placeholder="Title">
                                    
                                    <label for="inputEmail3" class="col-form-label">Content</label>
                                    <textarea class="form-control" name="gcontent[]"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card addbannersectionimage mb-0">
                                        <input type="hidden" name="gimage[]">
                                        <img src="{{ asset('/') }}images/product/productDefault.png" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"><button type="button" class="btn btn-danger btn-sm float-end deletebannersectionimage"><i class="bi bi-trash"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.bannersectionimagec').after(spec);

                // Initialize Select2 on the newly added dropdown
                $('.js-example-basic-single').select2({
                    minimumResultsForSearch: Infinity
                });
            });
            $('body').on('click', '.deletebannersectionimage', function() {
                $(this).closest('.remove-section').remove();
            });
            $('body').on('click', '.addbannersectionimage', function() {
                bimage = $(this);
                $('#bannersectionimagefile').click();
            });
            $('#bannersectionimagefile').change(function() {
                var file_data = $('#bannersectionimagefile').prop('files')[0];
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
            $('#addbannersectionimage').click(function() {
                $('#bannersectionimage').click();
            });
            $('#bannersectionimage').change(function() {
                const file = this.files[0];
                var sizeKB = file.size / 1024;

                if (sizeKB > 2048) {
                    $('.msg').html('<div class="text-danger">file size should less then 2MB.</div>');
                    return;
                } else if (!file.name.match(/\.(jpg|jpeg|png|gif)$/)) {
                    $('.msg').html('<div class="text-danger">this is not an image.</div>');
                    return;

                } else {
                    $('.msg').html('');
                }
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#bannersectionimagepreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/') }}assets/js/editors.js">
        < />
    @endsection

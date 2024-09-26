@extends('layouts.app')
@section('content')
    @if ($displaysolutions->design == 'standard')
        <main class="main_content">
            <section class="top-inner-banner">
                <div class="top_banner_slider top_banner_images">
                    @if (isset($sliders) && !empty($sliders))
                        @foreach ($sliders as $i => $slider)
                            <div class="banner_slide">
                                <div class="banner_slide_img">
                                    <figure>
                                        <img src="{{ asset(isset($slider->bimage) ? 'images/' . $slider->bimage : 'images/computerbanner.jpg') }}"
                                            alt="banner">
                                    </figure>
                                </div>
                                <div class="banner_slide_caption">
                                    @if (!empty($slider->btitle))
                                        <div class="container relative">
                                            <div class="top-banner-content">
                                                <h4>{{ $slider->btitle }}</h4>
                                                <p>{!! $slider->bcontent !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- slid end -->
                </div>
            </section>
            <section class="solution_sec sec_padd">
                <div class="container">
                    <div class="head_cmn text-center">
                        <h2 class="head_2">{{ $displaysolutions->short_description }}</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="sec_p text-center">
                                <p>{{ strip_tags(html_entity_decode($displaysolutions->content)) }}</p>
                            </div>
                        </div>
                    </div>
            </section>
            @if (isset($solutionDetail) && $solutionDetail->isNotEmpty())
                <section class="gray-bg  digital_sec">
                    <div class="container">
                        {{-- <div class="head_cmn text-center">
                        <h2 class="head_2">DIGITAL MENUS THAT SELL</h2>
                    </div> --}}
                        <div class="row g-4">
                            @foreach ($solutionDetail as $s)
                                <div class="col-md-4">
                                    <div class="digital_block_sec">
                                        <div class="img-wrap">
                                            <figure>
                                                <img src="{{ asset('images/' . $s->image) }}" alt="news img">
                                            </figure>
                                        </div>
                                        <div class="digital_block_content">
                                            <h3>{{ $s->heading }}</h3>
                                            <p>{!! $s->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
            @if (!empty($displaysolutions->bannerimage))
                <section class="solution_sec pt-5 ">
                    <div class="container">
                        <div class="head_cmn text-center">
                            <h2 class="head_2">{{ $displaysolutions->banner_title }}</h2>
                            <p>{!! $displaysolutions->banner_short_description !!}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="standard_display_banner">
                                    <figure>
                                        <img src="{{ asset('images/' . $displaysolutions->bannerimage) }}" alt="news img">
                                    </figure>

                                </div>
                            </div>
                        </div>

                </section>
            @endif
            @if (
                $slug == 'signedge-enterprise' ||
                    $slug == 'signedge-basic' ||
                    $slug == 'digital-signage' ||
                    $slug == 'signedge-display-network')
                <section class="Industry_content_sec sm-10">
                    <div class="container">
                        @if (isset($grid_section) && !empty($grid_section))
                            @foreach ($grid_section as $s)
                                <div class="row display_solution_row">
                                    <div class="col-md-8">
                                        <div class="panasonic_text">
                                            <h3>{{$s->gtitle}}</h3>
                                            <p>{{$s->gcontent}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panasonic_img">
                                                <img src="{{ asset(isset($s->gimage) ? 'images/' . $s->gimage : 'images/computerbanner.jpg') }}"
                                            alt="INDUSTRIES IMG">
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>
                </section>
            @endif

            @if ($slug == 'que-management-system')
                <section class=" queue-managementsec">
                    <div class="container">
                        <div class=" digital_video_sec">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/E4fbpdo_Nm4?mute=1&autoplay=1"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


                        </div>
                    </div>


                    <div class="container mt-4">
                        @if (isset($grid_section) && !empty($grid_section))
                            @foreach ($grid_section as $s)
                                <div class="managementsec_bannner">
                                    <img src="{{ asset(isset($s->gimage) ? 'images/' . $s->gimage : 'images/computerbanner.jpg') }}" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                </section>
            @endif

            <section class="case_studies sec_padd gray-bg Success_stories end_to_end_display_solutions">
                <div class="container">
                    <div class="head_cmn text-center">
                        <h2 class="head_2">END-TO-END DISPLAY SOLUTIONS</h2>
                    </div>

                    <div class="case_studies_slider end-to-end-display-solution">
                        @if ($homeDisplaySolution->isNotEmpty())
                            @foreach ($homeDisplaySolution as $i => $vl)
                                <div class="product_slide">
                                    <div class="product_item ">
                                        <figure>
                                            <img src="{{ asset(isset($vl->image) ? 'images/' . $vl->image : 'images/computerbanner.jpg') }}"
                                                alt="blog img">
                                        </figure>
                                        <div class="item_body">
                                            <div class="content">
                                                <h3>{{ $vl->title }}</h3>
                                                <div>{!! $vl->short_desc_home !!}</div>
                                            </div>
                                            <div class="know_more-link text-start btn-effect">
                                                @if ($i == 7)
                                                    <a href="https://pro-av.panasonic.net/en/" class="link">
                                                        Know More <i class="fas fa-external-link-alt"
                                                            style="margin-left: 5px;"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('displaysolutions', ['slug' => $vl->slug]) }}"
                                                        class="link">
                                                        Know More
                                                        <!-- <span class="arrow-right"><img src="{{ asset('/') }}images/Icon-arrow-right.svg"></span> -->
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>

            <section class="sec_padd inquire-now-section gray-bg">
                <div class="container">
                    <div class="head_cmn text-center mb-5 ">
                        <h2 class="head_2 mb-3">ENQUIRE NOW</h2>
                    </div>
                    <div class="inquire-now-form">
                        <form id="contact_form" method="POST" action="{{ route('aboutusPostInquiry') }}">
                            @csrf
                            <div class="mb-5 row">
                                <div class="col">
                                    <input type="text" required maxlength="50" class="form-control" id="first_name"
                                        name="first_name" placeholder="Name*" required>
                                </div>

                                <div class="col">
                                    <input type="text" required maxlength="50" class="form-control mobile" id="first_name"
                                        name="phone" placeholder="Mobile No.*"  onkeypress="return validateMobileNumber(event)" maxlength="10" required>

                                </div>

                                <div class="col">
                                    <input type="email" class="form-control" id="last_name" name="email"
                                        placeholder="Email Id*" required>
                                </div>
                            </div>
                            <div class="col-md-12 text-center"><button type="submit"
                                    class="btn inquire-now-link round-0">SUBMIT NOW</button></div>

                        </form>

                    </div>


                </div>
            </section>
        </main>
    @elseif($displaysolutions->design == 'alternate')
        <main class="main_content">
            <section class="top-inner-banner">
                <div class="top_banner_slider top_banner_images">
                    @if (isset($sliders) && !empty($sliders))
                        @foreach ($sliders as $i => $slider)
                            <div class="banner_slide">
                                <div class="banner_slide_img">
                                    <figure>
                                        <img src="{{ asset(isset($slider->bimage) ? 'images/' . $slider->bimage : 'images/computerbanner.jpg') }}"
                                            alt="banner">
                                    </figure>
                                </div>
                                <div class="banner_slide_caption">
                                    @if (!empty($slider->btitle))
                                        <div class="container relative">
                                            <div class="top-banner-content">
                                                <h4>{{ $slider->btitle }}</h4>
                                                <p>{!! $slider->bcontent !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- slid end -->
                </div>
            </section>
            <section class="breadcrumb-sec">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item">Display Solution</li>
                            <li class="breadcrumb-item">{{ $parentBredcrumName->title }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $displaysolutions->title }}</li>
                        </ol>
                    </nav>
                </div>
            </section>
            <section class="top-filter-sec">
                <div class="container">
                    <div class="filter-cst">
                        <div class="filter-left">
                            <div class="filter-icon">
                                <div class="icon"><span></span><span></span><span></span><span></span></div> Filter
                            </div>
                            <div class="product-found1">

                            </div>
                        </div>
                        <div class="category_select">
                            <select name="boxes" class="boxselect">
                                <option value="all">Newest</option>
                                <option value="iPRO1">iPRO1</option>
                                <option value="iPRO2">iPRO2</option>
                                <option value="iPRO3">iPRO3</option>
                                <option value="iPRO4">iPRO4</option>
                            </select>
                        </div>

                    </div>
                </div>
            </section>
            <section class="Products_listing_sec sec_padd">
                <div class="container">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="product_sidebar">
                                <div class="filter">
                                    <!-- <h5>Filter By</h5> -->




                                    <div class="box border-bottom">
                                        <div class="box-label">
                                            Industries
                                            <button class="btn ml-auto" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#inner-box2" aria-expanded="false"
                                                aria-controls="inner-box" id="out">
                                                <span class="fas fa-minus"></span>
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </div>
                                        <div id="inner-box2" class="mt-2 mr-1 collapse" style="">
                                            {{-- @foreach ($industries as $industry)
                                                <div class="filter-option">
                                                    <label class="tick">
                                                        {{ $industry->title }}
                                                        <input type="checkbox" class="industry-filter1"
                                                            data-industry-id1="{{ $industry->id }}">
                                                        <span class="check"></span>
                                                    </label>
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row ">
                                <div class="col-md-12 col-12">
                                    <div class="top-head-bar justify-content-between d-flex align-items-center">

                                    </div>
                                </div>
                                <div id="productsContainer1" class="row">
                                    <!-- Products will be dynamically added here -->
                                </div>

                                <div class="col-md-12 load-more-col text-center" id="loadMoreBtn1">
                                    <button class="load-more btn btn-primary">Load more</button>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h6 id="buttonTextContainer1"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>



        </main>
    @elseif($displaysolutions->design == 'basic')
        <main class="main_content">
            <section class="top-inner-banner">
                <div class="top_banner_slider top_banner_images">

                    @if (isset($sliders) && !empty($sliders))
                        @foreach ($sliders as $i => $slider)
                            <div class="banner_slide">
                                <div class="banner_slide_img">
                                    <figure>
                                        <img src="{{ asset(isset($slider->bimage) ? 'images/' . $slider->bimage : 'images/computerbanner.jpg') }}"
                                            alt="banner">
                                    </figure>
                                </div>
                                <div class="banner_slide_caption">
                                    @if (!empty($slider->btitle))
                                        <div class="container relative">
                                            <div class="top-banner-content">
                                                <h4>{{ $slider->btitle }}</h4>
                                                <p>{!! $slider->bcontent !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- slid end -->
                </div>
            </section>
            <section class="breadcrumb-sec">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item">Display Solution</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $displaysolutions->title }}</li>
                        </ol>
                    </nav>
                </div>
            </section>



            <section class="sec_padd product_display_solution">
                <div class="container">


                    <div class="head_cmn text-center">
                        <h2 class="head_2">{{ $displaysolutions->title }}</h2>
                        <div class="sec_p text-center">
                            {{-- <p>{{ $displaysolutions->content }}</p> --}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 mx-auto">

                        </div>
                    </div>

                    <div class="row align-items-center justify-content-center g-3">
                        @if ($getRelatedSolutions->isNotEmpty())
                            @foreach ($getRelatedSolutions as $i => $value)
                                @if ($i == 0)
                                    <div class="col-md-12">
                                        <div class="display_box">
                                            <div class="display_banner display_hover_top">
                                                <figure>
                                                    <img src="{{ asset(isset($value->image) ? 'images/' . $value->image : 'images/computerbanner.jpg') }}"
                                                        alt="banner">
                                                </figure>
                                                <div class="text-caption">
                                                    <h3>{{ $value->title }}</h3>
                                                    {{-- Example commented out code --}}
                                                    {{-- <p>{{ $getContent }}</p> --}}
                                                    <a href="{{ route('displaysolutions', ['slug' => $value->slug]) }}"
                                                        class="btn View-all-btn common-btn">View All <span
                                                            class="fas fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @php
                                        // Determine column classes based on iteration count
                                        $col_md = count($getRelatedSolutions) == 3 ? 'col-md-6' : 'col-md-6';
                                        $col_lg = count($getRelatedSolutions) > 3 ? 'col-lg-4' : 'col-lg-6';
                                    @endphp
                                    <div class="{{ $col_md }} {{ $col_lg }}">
                                        <div class="display_right">
                                            <div class="display_banner_fig display_hover">
                                                <figure>
                                                    <img src="{{ asset(isset($value->image) ? 'images/' . $value->image : 'images/computerbanner.jpg') }}"
                                                        alt="banner">
                                                </figure>
                                                <div class="text-caption">
                                                    <h3>{{ $value->title }}</h3>
                                                    {{-- Example commented out code --}}
                                                    {{-- <p>{{ $getContent }}</p> --}}
                                                    <a href="{{ route('displaysolutions', ['slug' => $value->slug]) }}"
                                                        class="btn View-all-btn common-btn">View All <span
                                                            class="fas fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                </div>
            </section>

            <section class="top-filter-sec">
                <div class="container">
                    <div class="filter-cst">
                        <div class="filter-left">
                            <div class="filter-icon">
                                <div class="icon"><span></span><span></span><span></span><span></span></div> Filter
                            </div>
                            <div class="product-found">

                            </div>
                        </div>
                        <div class="category_select">
                            <select name="boxes" class="boxselect">
                                <option value="all">Newest</option>
                                <option value="iPRO1">iPRO1</option>
                                <option value="iPRO2">iPRO2</option>
                                <option value="iPRO3">iPRO3</option>
                                <option value="iPRO4">iPRO4</option>
                            </select>
                        </div>

                    </div>
                </div>
            </section>

            <section class="Products_listing_sec sec_padd">
                <div class="container">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="product_sidebar">
                                <div class="filter">
                                    <!-- <h5>Filter By</h5> -->

                                    <div class="box border-bottom">
                                        <div class="box-label">
                                            Type
                                            <button class="btn ml-auto" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#inner-box" aria-expanded="false"
                                                aria-controls="inner-box" id="out">
                                                <span class="fas fa-minus"></span>
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </div>
                                        <div id="inner-box" class="mt-2 mr-1 collapse" style="">
                                            @if ($getAllSolutions->isNotEmpty())
                                                @foreach ($getAllSolutions as $i => $value)
                                                    <div class="filter-option">
                                                        <label class="tick">{{ $value->title }}
                                                            <input type="checkbox" class="series-filter"
                                                                data-series-id="{{ $value->id }}">
                                                            <span class="check"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>


                                    <div class="box border-bottom">
                                        <div class="box-label">
                                            Industries
                                            <button class="btn ml-auto" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#inner-box1" aria-expanded="false"
                                                aria-controls="inner-box1" id="out">
                                                <span class="fas fa-minus"></span>
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </div>
                                        <div id="inner-box1" class="mt-2 mr-1 collapse" style="">
                                            {{-- @if ($industries->isNotEmpty())
                                                @foreach ($industries as $industry)
                                                    <div class="filter-option">
                                                        <label class="tick">
                                                            {{ $industry->title }}
                                                            <input type="checkbox" class="industry-filter"
                                                                data-industry-id="{{ $industry->id }}">
                                                            <span class="check"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif --}}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row ">
                                <div class="col-md-12 col-12">
                                    <div class="top-head-bar justify-content-between d-flex align-items-center">

                                    </div>
                                </div>
                                <div id="productsContainer" class="row">
                                    <!-- Products will be dynamically added here -->
                                </div>

                                <div class="col-md-12 load-more-col text-center" id="loadMoreBtn">
                                    <button class="load-more btn btn-primary">Load more</button>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h6 id="buttonTextContainer"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endif

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var nextPageUrl = "{{ route('getProductList') }}";
        var selectedIndustries = [];
        var selectedSeries = [];
        var solutionPageTitle = "{{ $displaysolutions->slug ?? '' }}";

        loadProducts(nextPageUrl, solutionPageTitle);

        $('#inner-box').on('change', '.series-filter', function() {
            updateSelectedSeries();
            reloadProducts();
        });

        $('#inner-box1').on('change', '.industry-filter', function() {
            updateSelectedIndustries();
            reloadProducts();
        });

        $('#loadMoreBtn').click(function() {
            if (nextPageUrl) {
                loadProducts(nextPageUrl, solutionPageTitle);
            } else {
                $('#loadMoreBtn').remove();
            }
        });

        function updateSelectedSeries() {
            selectedSeries = $('.series-filter:checked').map(function() {
                return $(this).data('series-id');
            }).get();
        }

        function updateSelectedIndustries() {
            selectedIndustries = $('.industry-filter:checked').map(function() {
                return $(this).data('industry-id');
            }).get();
        }

        function reloadProducts() {
            nextPageUrl = "{{ route('getProductList') }}";
            $('#productsContainer').empty();
            loadProducts(nextPageUrl, solutionPageTitle);
        }

        function loadProducts(url, solutionTitle) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    industries: selectedIndustries,
                    solutionTitle: solutionTitle,
                    series: selectedSeries
                },
                success: function(response) {
                    if (Array.isArray(response.data) && response.data.length > 0) {
                        loadIndustries(response.data)
                        var totalCount = response.total;
                        displayProducts(response.data);
                        displayProductsTotalCount(totalCount);
                        nextPageUrl = response.next_page_url;
                        if (!nextPageUrl) {
                            $('#loadMoreBtn').remove();
                        }
                    } else {
                        displayProductsTotalCount(0);
                        $('#loadMoreBtn').remove();
                        $('#buttonTextContainer').text('No products available');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        function loadIndustries(products){

                let product=[];
                // let product=product1;
                // console.log(products)
                    if (Array.isArray(products)) {
                        products.forEach(function(data1) {

                        product.push(data1.id)
                        })
                    }else{
                        product.push(products.id)
                    }

                    $.ajax({
                    url: '{{ route('get-industries-for-products') }}',
                    method: 'POST',
                    data: {
                        product_ids: product,
                        _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                    },
                    success: function(response) {

                        var industries = response.industries;
                        // console.log(industries)
                        var industryFilters = $('#inner-box1');


                        industryFilters.find('input.industry-filter:checked').each(function() {
                            selectedIndustries.push($(this).data('industry-id'));
                });
                        // Clear existing filters
                        industryFilters.empty();

                        // Populate with new filters
                        var filters ='';
                        industries.forEach(function(industry) {
                            var isChecked = selectedIndustries.includes(industry.id) ? 'checked' : '';
                            
                            filters += '<div class="filter-option">' +
                                    '<label class="tick">' +
                                        industry.title +
                                        '<input type="checkbox" class="industry-filter" data-industry-id="' + industry.id + '" ' + isChecked + '>' +
                                        '<span class="check"></span>' +
                                    '</label>' +
                                '</div>'
                        });
                        //  console.log(filters)
                        industryFilters.append(filters)
                    },
                    error: function(xhr) {
                        console.error("An error occurred while fetching industries.");
                    }
                    });
        }
        function displayProducts(products) {
            var productHtml = '';
            products.forEach(function(data) {
                var featuredImage = data.featured_image ? 'images/' + data.featured_image :
                    'images/computerbanner.jpg';
                productHtml += `
                <div class="col-md-6 col-lg-4 col-xl-4 all iPRO1 select-box">
                    <div class="product mb-3">
                        <div class="product_img">
                            <a href="{{ url('product/${data.slug}') }}">
                                <figure>
                                 <img src="{{ asset('${featuredImage}') }}" alt="product img">
                            </figure>
                            </a>
                        </div>
                        <div class="product_details">
                            <div class="product_code">${data.model}</div>
                            <div class="product_name">
                                <h4>${data.title}</h4>
                            </div>
                            <div class="product_des">
                                <p>${data.short_description}</p>
                            </div>
                            <a href="{{ url('product/${data.slug}') }}" class="inquire-now-btn">VIEW DETAILS</a>
                        </div>
                    </div>
                </div>`;
            });
            $('#productsContainer').append(productHtml);
        }

        function displayProductsTotalCount(totalCount) {
            var productCount = totalCount + (totalCount === 1 ? ' product found' : ' products found');
            $('.product-found').text(productCount);
        }
    });
</script>
<script>
    $(document).ready(function() {
        var nextPageUrl1 = "{{ route('getProductListFilterParticularPage') }}";
        var selectedIndustries1 = []; // Array to hold selected industry IDs

        // Fetch solutionTitle initially from PHP/Laravel
        var solutionPageTitle1 = "{{ $displaysolutions->slug ?? '' }}";

        // Initial page load
        loadProducts1(nextPageUrl1, solutionPageTitle1);

        $('#inner-box2').on('change', '.industry-filter1', function() {
            updateSelectedIndustries1();
            reloadProducts1();
        });

        // Load more button click handler
        $('#loadMoreBtn1').click(function() {
            if (nextPageUrl1) {
                loadProducts1(nextPageUrl1, solutionPageTitle1);
            } else {
                var buttonText = $('#loadMoreBtn1').text(); // Get the current text of the button
                $('#loadMoreBtn1').remove();
            }
        });

        function updateSelectedIndustries1() {
            selectedIndustries1 = [];
            $('.industry-filter1:checked').each(function() {
                selectedIndustries1.push($(this).data('industry-id1'));
            });
        }

        // Function to reload products based on filters
        function reloadProducts1() {
            nextPageUrl1 = "{{ route('getProductListFilterParticularPage') }}"; // Reset to initial URL
            $('#productsContainer1').empty(); // Clear existing products
            loadProducts1(nextPageUrl1, solutionPageTitle1); // Load products with the new filters
        }

        // Function to load products with AJAX
        function loadProducts1(url, solutionTitle) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    industries: selectedIndustries1,
                    solutionTitle: solutionTitle,
                },
                success: function(response) {
                    if (Array.isArray(response.data) && response.data.length > 0) {
                        loadIndustries1(response.data)
                        var totalCount = response.total;
                        response.data.forEach(function(item) {
                            displayProducts1(item);
                            displayProductsTotalCount1(totalCount);
                        });
                        var newText = ''; // Replace with your desired text
                        $('#buttonTextContainer').text(newText);
                        // Update nextPageUrl1 with the next page URL if available
                        nextPageUrl1 = response.next_page_url;
                        if (!nextPageUrl1) {
                            var buttonText = $('#loadMoreBtn1')
                                .text(); // Get the current text of the button
                            $('#loadMoreBtn1').remove();
                        }
                    } else {
                        var totalCount = 0;
                        displayProductsTotalCount1(totalCount);
                        // No more products
                        var buttonText = $('#loadMoreBtn1')
                            .text(); // Get the current text of the button
                        $('#loadMoreBtn1').remove(); // Remove the button from the DOM
                        var newText = 'No products available'; // Replace with your desired text
                        $('#buttonTextContainer1').text(newText);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to display a product
        function displayProducts1(data) {
            var featuredImage = data.featured_image ? 'images/' + data.featured_image :
                'images/computerbanner.jpg';
            var productHtml = `
            <div class="col-md-6 col-lg-4 col-xl-4 all iPRO1 select-box">
                <div class="product mb-3">
                    <div class="product_img">
                       <a href="{{ url('product/${data.slug}') }}">
                          <figure>
                            <img src="{{ asset('${featuredImage}') }}" alt="product img">
                        </figure>
                        </a>
                    </div>
                    <div class="product_details">
                        <div class="product_code">${data.model}</div>
                        <div class="product_name">
                            <h4>${data.title}</h4>
                        </div>
                        <div class="product_des">
                            <p>${data.short_description?? ' '}  </p>
                        </div>
                        <a href="{{ url('product/${data.slug}') }}" class="inquire-now-btn">VIEW DETAILS</a>
                    </div>
                </div>
            </div>
        `;
            // Append productHtml to productsContainer
            $('#productsContainer1').append(productHtml);
        }

        function displayProductsTotalCount1(totalCount) {
            var productCount = totalCount + (totalCount === 1 ? ' product found' : ' products found');
            $('.product-found1').text(productCount);
        }
        function loadIndustries1(products){

            let product=[];
            // let product=product1;
            // console.log(products)
                if (Array.isArray(products)) {
                    products.forEach(function(data1) {

                    product.push(data1.id)
                    })
                }else{
                    product.push(products.id)
                }
            
                $.ajax({
                url: '{{ route('get-industries-for-products') }}',
                method: 'POST',
                data: {
                    product_ids: product,
                    _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                },
                success: function(response) {

                    var industries = response.industries;
                    // console.log(industries)
                    var industryFilters = $('#inner-box2');


                    industryFilters.find('input.industry-filter1:checked').each(function() {
                        selectedIndustries1.push($(this).data('industry-id1'));
            });
                    // Clear existing filters
                    industryFilters.empty();

                    // Populate with new filters
                    var filters ='';
                    industries.forEach(function(industry) {
                        var isChecked = selectedIndustries1.includes(industry.id) ? 'checked' : '';
                        
                        filters += '<div class="filter-option">' +
                                '<label class="tick">' +
                                    industry.title +
                                    '<input type="checkbox" class="industry-filter1" data-industry-id1="' + industry.id + '" ' + isChecked + '>' +
                                    '<span class="check"></span>' +
                                '</label>' +
                            '</div>'
                    });
                    //  console.log(filters)
                    industryFilters.append(filters)
                },
                error: function(xhr) {
                    console.error("An error occurred while fetching industries.");
                }
                });
        }
    });
</script>
<script>
    function validateMobileNumber(event) {
        // Get the current input value
        let inputValue = event.target.value;
        
        // Check if the entered key is a number and if the total length is less than or equal to 10
        if (event.keyCode >= 48 && event.keyCode <= 57 && inputValue.length < 10) {
            return true;
        } else {
            event.preventDefault(); // Prevent the character from being entered
            return false;
        }
    }
    </script>
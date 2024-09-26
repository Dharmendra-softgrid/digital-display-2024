@extends('layouts.app')
@section('content')
    <style>
        .content_tab .col-md-6 {
            padding: 0;
        }

        .product_tab_content {
            padding: 60px;
        }

        .tab-row-sec:nth-child(2n+2) {
            border: none;
            display: flex;
            flex-direction: row-reverse;
        }

        /* css added for zoom effect */
        .product-thumbnail-image {
            position: relative;
            width: 100px; /* Original thumbnail size */
            overflow: hidden;
            cursor: pointer;
        }

        .enlarged-thumbnail {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Match the width of the target div */
            height: auto;
            z-index: 1000;
            transition: all 0.3s ease-in-out;
        }

        @media only screen and (max-width: 767px) {
            .content_tab .col-md-6 {
                padding: 0 15px;
            }

            .product_tab_content {
                padding: 20px;
            }

            .brochurer-download a.download-link {
                min-width: 130px;
            }

        }
    </style>
    <?php //print_r($successstory);
    ?>
    <main class="main_content">
        <section class="breadcrumb-sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="Products_details_page">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <!-- <div class="Products_img">
                                                                                                                                                                   <img class="img-fluid" src="assets/images/product_img.png" alt="Products">
                                                                                                                                                                </div> -->

                        <div class="product-vehicle-detail-banner banner-content clearfix">
                            <div class="product-banner-slider">
                                <div class="productslider slider-for-product">
                                    @if (!empty($productImages->isNotEmpty()))
                                        @foreach ($productImages as $pi)
                                            <div class="slider-banner-image">
                                                <img class="img-fluid"
                                                    src="{{ asset(isset($pi->image) ? 'images/product/' . $pi->image : 'images/computerbanner.jpg') }}"
                                                    alt="Products">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="slider slider-nav product-thumb-image">
                                    @if (!empty($productImages->isNotEmpty()))
                                        @foreach ($productImages as $pi)
                                            <div class="product-thumbnail-image">
                                                <div class="productThumbImg">
                                                    <img src="{{ asset(isset($pi->image) ? 'images/product/' . $pi->image : 'images/computerbanner.jpg') }}"
                                                        alt="slider-img">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="main_products_details">
                            <div class="product_description">
                                <div class="products_code product_small_name">{{ $product->model }}</div>
                                <div class="products_name">
                                    <h2>{{ $product->title }}</h2>
                                </div>
                                <div class="product_info">
                                    {!! $product->short_description !!}
                                </div>
                            </div>
                            <div class="product_info">
                                {!! $product->description !!}
                            </div>
                            @if (!empty($productVariant->isNotEmpty()))
                            <div class="choose_size">
                                <h5>Choose Your Size</h5>

                                <div class="Size_button_block">
                                   
                                        @foreach ($productVariant as $index => $item)
                                            <div class="radio_button">
                                                <input class="default-checked" type="radio" id="{{ $item->variant }}"
                                                    name="type" value="{{ $item->variant }}"
                                                    @if ($loop->first) checked @endif
                                                    onclick="fetchProductDetails({{ $item->variant }}, {{ $product->id }})"
                                                    data-variant-id="{{ $item->variant }}"
                                                    data-product-id="{{ $product->id }}">
                                                <label data-icon="M" for="{{ $item->variant }}">
                                                    <p>{{ DB::table('variant_list')->where('id', $item->variant)->value('name') }}
                                                    </p>
                                                </label>
                                            </div>
                                        @endforeach
                                    

                                </div>

                            </div>
                            @endif
                            <div class="inquire-block mt-4">
                                <a class="inquire-now-link" href="{{route('inquire-now')}}">ENQUIRE NOW</a>
                            </div>


                        </div>
                    </div>

                </div>
        </section>
        <section class="product_tab_sec">
            <div class="container">
                <nav class="tab_nav">
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-features-tab" data-bs-toggle="tab"
                            data-bs-target="#features" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Key Features</button>
                        <button class="nav-link" id="nav-specifications-tab" data-bs-toggle="tab"
                            data-bs-target="#specifications" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Specifications</button>
                        <button class="nav-link" id="nav-resources-tab" data-bs-toggle="tab" data-bs-target="#resources"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Download
                            brochures</button>
                        <button class="nav-link" id="nav-RelatedProducts-tab" data-bs-toggle="tab"
                            data-bs-target="#RelatedProducts" type="button" role="tab" aria-controls="nav-contact"
                            aria-selected="false">Related Products</button>
                    </div>
                </nav>

                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="features" role="tabpanel"
                        aria-labelledby="nav-features-tab">
                        <!-- Key Features start -->
                        <div class="tabs_container">
                            <h3 class="desktop_hide mobile_title ">Key Features</h3>
                            <div class="featurescontent tabs_content_block">
                                <div class="featurescontent text-center">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 productKeyFeatureDescription-container">

                                        </div>
                                    </div>
                                </div>
                                <!-- Key Features End -->
                                <div class="content_tab productKeyFeature-container">

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <!--specifications  start -->

                        <div class="tabs_container">
                            <h3 class="desktop_hide mobile_title ">Specifications</h3>
                            <div class="tabs_content_block productComponent-container">

                            </div>
                        </div>
                        <!--specifications end  -->
                    </div>
                    <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="av-resources-tab">
                        <!-- resources start -->
                        <div class="tabs_container">
                            <h3 class="desktop_hide mobile_title ">Download brochures</h3>
                            <div class="resources-sec tabs_content_block broschures-container">
                            </div>
                        </div>
                        <!-- resources end -->
                    </div>
                    <div class="tab-pane fade" id="RelatedProducts" role="tabpanel"
                        aria-labelledby="nav-RelatedProducts-tab">
                        <div class="tabs_container">
                            <h3 class="desktop_hide mobile_title ">Related Products</h3>
                            <div class="tabs_content_block">
                                <!-- related product start -->
                                <div class="row">
                                    @if (!empty($relatedProducts->isNotEmpty()))
                                        @foreach ($relatedProducts as $relatedProduct)
                                            <div class="col-md-6 col-lg-3 col-xl-3">
                                                <div class="product py-4">
                                                    <div class="product_img">
                                                        <figure>
                                                            <img src="{{ asset(isset($relatedProduct->featured_image) ? 'images/' . $relatedProduct->featured_image : 'images/computerbanner.jpg') }}"
                                                                alt="product img">
                                                        </figure>
                                                    </div>
                                                    <div class="product_details">
                                                        <div class="product_code">LH-98QM6HVS</div>
                                                        <div class="product_name">
                                                            <h4>{{ $relatedProduct->title }}</h4>
                                                        </div>
                                                        <div class="product_des">
                                                            <p>{{ $relatedProduct->short_description }}</p>
                                                        </div>
                                                        <a href="{{ url('product/' . $relatedProduct->slug) }}"
                                                            class="inquire-now-btn">ENQUIRE NOW</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-6 col-lg-3 col-xl-3">
                                            <div class="product py-4">
                                                <div>No data found</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- related product end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $("#image-slider").on("input", function() {
            var selectedImage = $(this).val();
            $(".product-image").hide();
            $("#image" + selectedImage).show();
        });
    });

    const baseUrl = "{{ asset('images/product/') }}";
    const defaultImage = "{{ asset('images/computerbanner.jpg') }}";
    const brurl = "{{ asset('specesheet/') }}";

    $(document).ready(function() {
        // Your code here
        let defaultCheckedVariant = $('.default-checked');
        if (defaultCheckedVariant.length) {
            let variantId = defaultCheckedVariant.data('variant-id');
            let productId = defaultCheckedVariant.data('product-id');
            fetchProductDetails(variantId, productId);
        }
    });

    function fetchProductDetails(variantId, productId) {
        $.ajax({
            url: "{{ route('fetchProductDetails') }}",
            method: 'GET',
            data: {
                product_id: productId,
                variant_id: variantId
            },
            success: function(response) {
                let data = '';
                if (response.productKeyFeature == 0) {
                    if (response.productKeyFeatureDescription == 0) {
                        data = getProductKeyFeatureData();
                    }
                } else {
                    $.each(response.productKeyFeature, function(index, item) {
                        data += getProductKeyFeatureHtml(item, index);
                    });
                }
                $('.productKeyFeature-container').html(data);

                if (response.productKeyFeatureDescription == 0) {
                    data = ''; // Reset data for the next section
                } else {
                    data = ''; // Reset data for the next section
                    $.each(response.productKeyFeatureDescription, function(index, item) {
                        data += getProductKeyFeatureDescDataHtml(item);
                    });
                }
                $('.productKeyFeatureDescription-container').html(data);

                if (response.broschures == 0) {
                    data = getBroschuresData();
                } else {
                    data = ''; // Reset data for the next section
                    $.each(response.broschures, function(index, item) {
                        data += getBroschuresDataHtml(item);
                    });
                }
                $('.broschures-container').html(data);
                let productComponents = '';
                productComponents = getProductComponentDataHtml(response.productComponents);

                $('.productComponent-container').html(productComponents);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Define other functions like getProductKeyFeatureHtml, etc.
    function getProductKeyFeatureHtml(data, index) {
        let html = '';
        const imageUrl = data.image ? `${baseUrl}/${data.image}` : defaultImage;

        if (index % 2 === 0) {
            html += `
                <div class="row align-items-center tab-row-sec">
                    <div class="col-md-6 right-col col-img">
                        <div class="product-tab-img">
                            <img class="img-fluid" src="${imageUrl}" alt="Products">
                        </div>
                    </div>
                    <div class="col-md-6 left-col col-content">
                        <div class="product_tab_content">
                            <h4>${data.title}</h4>
                            <p>${data.description}</p>
                        </div>
                    </div>
                </div>
              `;
        } else {
            html += `
              <div class="row align-items-center tab-row-sec">
                  <div class="col-md-6 right-col col-img">
                      <div class="product-tab-img">
                          <img class="img-fluid" src="${imageUrl}" alt="Products">
                      </div>
                  </div>
                  <div class="col-md-6 left-col col-content">
                      <div class="product_tab_content">
                          <h4>${data.title}</h4>
                          <p>${data.description}</p>
                      </div>
                  </div>
              </div>
            `;
        }
        return html;
    }

    function getProductKeyFeatureData() {
        let html = '';
        return html += `<div>No data found</div>`;
    }

    function getProductKeyFeatureDescDataHtml(data, index) {
        return `<div class=" mb-5">${data.description}</div>`;
    }

    function getProductComponentDataHtml(productComponents) {
        let html = '';
        html += `<div class="accordion" id="featuresAccordion">`;

        if (!productComponents || Object.keys(productComponents).length === 0) {
            html += `<p>No data found</p>`;
        } else {
            Object.keys(productComponents).forEach((componentType, typeIndex) => {
                const components = productComponents[componentType];
                const isFirstItem = typeIndex === 0;

                html += `
            <div class="accordion-item">
                <h2 class="accordion-header" id="Heading${typeIndex}">
                    <button class="accordion-button ${isFirstItem ? '' : 'collapsed'}" type="button" data-bs-toggle="collapse"
                        data-bs-target="#Collapse${typeIndex}"
                        aria-expanded="${isFirstItem ? 'true' : 'false'}"
                        aria-controls="Collapse${typeIndex}">
                        ${componentType}
                    </button>
                </h2>
                <div id="Collapse${typeIndex}"
                    class="accordion-collapse collapse ${isFirstItem ? 'show' : ''}"
                    aria-labelledby="Heading${typeIndex}"
                    data-bs-parent="#featuresAccordion">
                    <div class="accordion-body">
                        <div class="specifications">`;

                let hasNonEmptyName = false;
                components.forEach(component => {
                    if (component.component_name && component.component_name.trim() !== '') {
                        hasNonEmptyName = true;
                    }
                });

                if (hasNonEmptyName) {
                    html += `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Component Name</th>
                                        <th>Specification</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                }

                components.forEach((component, index) => {
                    const componentName = component.component_name;
                    const componentSpec = component.component_specification;

                    if (componentName && componentName.trim() !== '') {
                        html += `
                                    <tr>
                                        <td>${componentName}</td>
                                        <td>${componentSpec}</td>
                                    </tr>`;
                    } else {
                        html += `
                                    <p>${componentSpec}</p>`;
                    }
                });

                if (hasNonEmptyName) {
                    html += `
                                </tbody>
                            </table>`;
                }

                html += `
                        </div>
                    </div>
                </div>
            </div>`;
            });
        }

        html += `</div>`;
        return html;
    }


    function getBroschuresDataHtml(data, index) {

        let html = '';
        const pdfUrl = data.value ? `${brurl}/${data.value}` : 0;
        return html += `
              <ul>
                <li>
                    <h5>Manual files</h5>
                    <div class="brochure-block">
                        <div class="brochure-item">
                            <div class="brochure-thumbnail">
                                <embed src="${pdfUrl}"
                                    width="50px" height="70px" />
                            </div>
                            <p><a href="{{ asset('specesheet/') }}/${data.value}" class="card-link mt-3" target="_blank">${data.value}</a></p>
                        </div>
                        <div class="brochurer-right">
                            <p class="desktop_hide">${data.value}</p>
                            <div class="brochurer-download">
                                <a class="download-link"
                                    href="${pdfUrl}"
                                    download="">Download</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            `;
    }

    function getBroschuresData() {
        let html = '';
        return html += `<div>No data found</div>`;
    }
</script>
<script>
    // document.querySelectorAll('.product-thumbnail-image').forEach(function(thumb) {
    //     thumb.addEventListener('mouseover', function() {
    //         thumb.style.zIndex = 10;
    //     });
    
    //     thumb.addEventListener('mouseout', function() {
    //         thumb.style.zIndex = 1;
    //     });
    // });

    document.querySelectorAll('.product-thumbnail-image').forEach(function(thumb) {
    thumb.addEventListener('mouseover', function() {
        var targetDiv = document.querySelector('.slider-banner-image[data-slick-index="1"]');
        var enlargedImage = thumb.querySelector('img').cloneNode(true);

        // Add a special class for styling
        enlargedImage.classList.add('enlarged-thumbnail');

        // Append the enlarged image to the target div
        targetDiv.appendChild(enlargedImage);
        targetDiv.style.opacity = '1'; // Make sure the target div is visible
    });

    thumb.addEventListener('mouseout', function() {
        var targetDiv = document.querySelector('.slider-banner-image[data-slick-index="1"]');
        var enlargedImage = targetDiv.querySelector('.enlarged-thumbnail');

        if (enlargedImage) {
            enlargedImage.remove();
        }
    });
});
    </script>
@extends('layouts.app')


@section('content')
    <main class="main_content">
        <section class="top-inner-banner main_about_banner">
            <div class="about_banner_slider">
                <div class="banner_video">
                    <video autoplay="" id="video" loop="" muted="" playsinline=""
                        poster="https://content.connect.panasonic.com/jp-ja/fai/36780/raw" webkit-playsinline="">
                        <source src="{{ asset('videos/about_banner_video.mp4') }}">
                        <p>Unable to play video.</p>
                    </video>
                    <div class="banner_img">
                        <img
                            src="{{ asset(isset($slider->image) ? 'images/' . $slider->image : 'images/computerbanner.jpg') }}">
                    </div>

                </div>
                {{-- <div class="container relative">
                    <div class="top-banner-content">
                        <h3>Modernize your QSR</h3>
                        <p>Powerful end-to-end quick service display and software solutions, perfect for restaurants and
                            other commercial food service industries.</p>
                    </div>
                </div> --}}

            </div>
        </section>
        @if(!empty($first_sec_content->title))
        <section class="">
            <div class="container">
                <div class="head_cmn text-center">
                    <h2 class="head_2 mb-3">{!! $first_sec_content->title ?? ' ' !!}</h2>
                    <p class="fon-20 sub_title gray-color">{!! $first_sec_content->content ?? ' ' !!}</p>
                </div>

            </div>
        </section>
        @endif
        @if(!empty($second_sec_content->title))
        <section class="sec_padd about-video-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="about-video-block">
                            <div class="video_sec wow fadeInRight" data-wow-duration="0.4s" data-wow-delay="0.6s">
                                <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/m3jeQ-y2wyA?si=6Go-ovKVxa9lNekS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                                <iframe width="560" height="315"
                                    src="{{$videoLink->link}}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; autostop; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-video-text">
                            <h3>{!! $second_sec_content->title ?? ' ' !!}</h3>
                            <p>{!! $second_sec_content->content ?? ' ' !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        @endif
        
        <section class="sec_padd our-technology">
            <div class="container">
              @if(!empty($third_sec_content->title))
                <div class="head_cmn text-center mb-5 ">
                    <h2 class="head_2 mb-3">{!! $third_sec_content->title ?? ' ' !!}</h2>
                </div>
                @endif
                @if(!empty($fourth_sec_content->content))
                <div class="tech-block-list">
                    <div class="row">
                        <div class="col-md-6 tech-content">
                            <div class="tech-block">
                                <h2>{!! $fourth_sec_content->title ?? ' ' !!}</h2>
                                <p> {!! $fourth_sec_content->content ?? ' ' !!}</p>
                                <span class="gray-shape"><img src="{{ asset('/') }}images/left-gray-shap.png"></span>
                            </div>
                        </div>
                        <div class="col-md-6 tech-img">

                            <div class="technology-img">
                                <span class="shape"><img src="{{ asset('/') }}images/yellow-shap.png"></span>
                                <figure>
                                    <img src="{{ asset(isset($fourth_sec_content->image) ? 'images/' . $fourth_sec_content->image : 'images/computerbanner.jpg') }}"
                                        alt="img">
                                </figure>

                            </div>

                        </div>
                    </div>
                    <!-- row -->
                </div>
                @endif
                @if(!empty($fifth_sec_content->title))
                <div class="tech-block-list">
                    <div class="row">
                        <div class="col-md-6 tech-content">
                            <div class="tech-block">
                                <h2>{!! $fifth_sec_content->title ?? ' ' !!}</h2>
                                <p>{!! $fifth_sec_content->content ?? ' ' !!}</p>
                                <span class="gray-shape"><img src="{{ asset('/') }}images/left-gray-shap.png"></span>
                            </div>
                        </div>
                        <div class="col-md-6 tech-img">

                            <div class="technology-img">
                                <span class="shape"><img src="{{ asset('/') }}images/yellow-shap.png"></span>
                                <figure>
                                    <img src="{{ asset(isset($fifth_sec_content->image) ? 'images/' . $fifth_sec_content->image : 'images/computerbanner.jpg') }}"
                                        alt="img">
                                </figure>
                            </div>

                        </div>
                    </div>
                    <!-- row -->
                </div>
                @endif
                @if(!empty($sixth_sec_content->title))
                <div class="tech-block-list">
                    <div class="row">
                        <div class="col-md-6 tech-content">
                            <div class="tech-block">
                                <h2>{!! $sixth_sec_content->title ?? ' ' !!}</h2>

                                <p>{!! $sixth_sec_content->content ?? ' ' !!}</p>

                                <span class="gray-shape"><img src="{{ asset('/') }}images/left-gray-shap.png"></span>
                            </div>
                        </div>
                        <div class="col-md-6 tech-img">

                            <div class="technology-img">
                                <span class="shape"><img src="{{ asset('/') }}images/yellow-shap.png"></span>
                                <figure>
                                    <img src="{{ asset(isset($sixth_sec_content->image) ? 'images/' . $sixth_sec_content->image : 'images/computerbanner.jpg') }}"
                                        alt="img">
                                </figure>
                            </div>

                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- tech-block-list -->
                @endif
                @if(!empty($seventh_sec_content->title))

                <div class="tech-block-list">
                    <div class="row">
                        <div class="col-md-6 tech-content">
                            <div class="tech-block">
                                <h2>{!! $seventh_sec_content->title ?? ' ' !!}</h2>
                                <p>{!! $seventh_sec_content->content ?? ' ' !!}</p>

                                <span class="gray-shape"><img src="{{ asset('/') }}images/left-gray-shap.png"></span>
                            </div>
                        </div>
                        <div class="col-md-6 tech-img">

                            <div class="technology-img">
                                <span class="shape"><img src="{{ asset('/') }}images/yellow-shap.png"></span>
                                <figure>
                                    <img src="{{ asset(isset($seventh_sec_content->image) ? 'images/' . $seventh_sec_content->image : 'images/computerbanner.jpg') }}"
                                        alt="img">
                                </figure>
                            </div>

                        </div>
                    </div>
                    <!-- row -->
                </div>
                @endif
                @if(!empty($eighth_sec_content->title))
                <!-- tech-block-list -->
                <div class="tech-block-list">
                    <div class="row">
                        <div class="col-md-6 tech-content">
                            <div class="tech-block">
                                <h2>{!! $eighth_sec_content->title ?? ' ' !!}</h2>
                                <p>{!! $eighth_sec_content->content ?? ' ' !!}</p>

                                <span class="gray-shape"><img src="{{ asset('/') }}images/left-gray-shap.png"></span>
                            </div>
                        </div>
                        <div class="col-md-6 tech-img">

                            <div class="technology-img">
                                <span class="shape"><img src="{{ asset('/') }}images/yellow-shap.png"></span>
                                <figure>
                                    <img src="{{ asset(isset($eighth_sec_content->image) ? 'images/' . $eighth_sec_content->image : 'images/computerbanner.jpg') }}"
                                        alt="img">
                                </figure>
                            </div>

                        </div>
                    </div>
                    <!-- row -->
                </div>
                @endif
                <!-- tech-block-list -->





            </div>
        </section>


        <section class="sec_padd inquire-now-section gray-bg">
            <div class="container">
                <div class="head_cmn text-center mb-5 ">
                    <h2 class="head_2 mb-3">ENQUIRE NOW</h2>
                </div>
                <div class="inquire-now-form">
                    <form id="contact_form" method="POST" action="{{route('aboutusPostInquiry')}}">
                        @csrf
                        <div class="mb-5 row">
                            <div class="col">
                                <input type="text" required maxlength="50" class="form-control" id="first_name"
                                    name="first_name" placeholder="Name*" required>
                            </div>

                            <div class="col">
                                <input type="text" class="form-control" id="mobile" name="phone"
                                placeholder="Mobile No.*" onkeypress="return validateMobileNumber(event)" maxlength="10" required>

                            </div>

                            <div class="col">
                                <input type="email" class="form-control" id="last_name" name="email"
                                    placeholder="Email Id*" required>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn inquire-now-link round-0">SUBMIT NOW</button></div>
                    </form>
                </div>
            </div>
        </section>
    </main>
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
@endsection

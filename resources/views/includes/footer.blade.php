<footer class="footer_sec">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 footer-logo">
                <div class="ftr_logo">
                    <a class="" href="{{ url('/') }}">
                        <img src="{{ asset('/') }}images/logo.png" alt="logo">
                    </a>
                </div>
                <div class="footer_social">
                    <h4>Follow Us</h4>
                    <ul class="social_main">
                        <li>
                            <a href="{{url($settings_instagram->svalue)}}" class="social_insta link" target="_blank"><i style="margin-top: 6px"
                                    class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{url($settings_twitter->svalue)}}" class="social_twitter link" target="_blank"><i style="margin-top: 6px"
                                    class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{url($settings_facebook->svalue)}}" class="social_fb link" target="_blank"><i style="margin-top: 6px"
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{url($settings_linkedin->svalue)}}" class="social_fb link" target="_blank"><i style="margin-top: 6px"
                                    class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="{{url($settings_youtube->svalue)}}" class="social_yt link" target="_blank"><i style="margin-top: 6px"
                                    class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-2 footer_col">
                <div class="ftr_title">
                    <h3>Solutions</h3>
                </div>
                <ul class="footer_menu_main justify-content-md-between">
                    @if ($menus->isNotEmpty())
                        @foreach ($menus as $i => $nr)
                            @if ($nr->parent == 0)
                                @if ($nr->title == 'Display Solutions')
                                    <li class="col-auto">
                                        <a href="#">{{ $nr->title }}</a>
                                    </li>
                                @endif
                                @if ($nr->title == 'Broadcast Solutions')
                                    <li class="col-auto">
                                        <a href="{{ $nr->link }}">{{ $nr->title }} <i
                                                class="fas fa-external-link-alt"></i></a>
                                    </li>
                                @endif
                                @if ($nr->title == 'Projectors')
                                    <li class="col-auto">
                                        <a href="{{ $nr->link }}">{{ $nr->title }} <i
                                                class="fas fa-external-link-alt"></i></a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-12 col-md-2 footer_col">
                <div class="ftr_title">
                    <h3>Industries</h3>
                </div>
                <ul class="footer_menu_main justify-content-md-between">
                    @foreach ($industries as $i)
                        <li class="col-auto">
                            <a href="{{ route('industry', ['slug' => $i->slug]) }}">{{ $i->title }} </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-2 footer_col">
                <div class="ftr_title">
                    <h3>Other Links</h3>
                </div>
                <ul class="footer_menu_main justify-content-md-between">
                    <li class="col-auto">
                        <a href="{{ route('aboutus') }}">About Us</a>
                    </li>
                    <li class="col-auto">
                        <a href="{{ route('news-and-blogs') }}">News & Blogs</a>
                    </li>
                    <li class="col-auto">
                        <a href="{{ route('success-stories') }}">Success Stories</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-3 contact_us footer_col">
                <div class="ftr_title">
                    <h3>Contact Us</h3>
                </div>
                <ul class="footer_menu_main gx-2 justify-content-md-between">
                    <li class="col-auto">
                        <p>{{$settings_address->svalue}}</p>
                    </li>
                    <li class="col-auto">
                        Toll free number: {{$settings_mobile->svalue}}
                    </li>
                    <li class="col-auto">
                        Email ID: {{$settings_email->svalue}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="top-border"></div>
        <div class="row justify-content-between align-items-center ftr-bottom-menu">
            <div class="col col-md-auto">
                <div class="ftr_left_menu">
                    <p>
                        <a class="{{ request()->is('privacy-policy') ? 'active' : '' }}"
                            href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    </p>
                </div>
            </div>
            <div class="col col-md-auto copyright_column">
                <div class="copyright_text"> © All rights are reserved.</div>
            </div>
            <div class="col-auto">
                <div class="ftr_right_menu">
                    <p>
                        <a class="{{ request()->is('terms-and-conditions') ? 'active' : '' }}"
                            href="{{ route('terms-and-conditions') }}">Terms of Use</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

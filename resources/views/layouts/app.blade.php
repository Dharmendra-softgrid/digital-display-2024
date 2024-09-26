<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
        <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}" >
        <link rel="stylesheet" href="{{asset('css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <title>Panasonic</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <!-- <script src="assets/js/jquery-3.2.1.min.js" ></script> -->
        <!-- Option 1: Bootstrap Bundle with Popper -->        
        <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/fontawesome-all.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/script_custom.js')}}"></script>
    </head>
    <body>


        @include('includes.header')
        <main class="main_content">
            @yield('content')
        </main>
        @include('includes.footer')

        <!-- Modal -->
        <div class="modal fade" id="video_popup" tabindex="-1" aria-labelledby="video_popupLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe width="100%" height="450" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
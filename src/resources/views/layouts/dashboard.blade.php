
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="public/vendor/css/app.css"> --}}
    

    <link href="{{asset('/vendor/blog/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="icon" type="image/x-icon" href="{{asset('/vendor/blog/assets/img/favicon.ico')}}"/>
    <link href="{{asset('/vendor/blog/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('/vendor/blog/assets/js/loader.js')}}"></script>
    <link href="{{asset('/vendor/blog/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/blog/assets/css/elements/alert.css')}}">

    @livewireStyles
    @yield('css')
    @stack('css');
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px)!important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('blog::layouts.partials.navbar')



    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('blog::layouts.partials.sidebar')
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    @yield('content')
                    {{$slot ?? ''}}
                </div>

            </div>
            <div class="footer-wrapper">
                {{-- <div class="footer-section f-section-1">
                    <p class=""> © کپی رایت</p>
                </div>
                <div class="footer-section f-section-2">
                    <span class="copyright"> بومی سازی شده توسط : <a href="https://imanpa.ir/store/"> ایمان پاکروح </a> </span>
                </div> --}}
            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('/vendor/blog/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('/vendor/blog/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('/vendor/blog/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/vendor/blog/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('/vendor/blog/assets/js/app.js')}}"></script>
    <script src="{{asset('/vendor/blog/plugins/font-icons/feather/feather.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('/vendor/blog/assets/js/custom.js')}}"></script>
    <script>
            feather.replace();
    </script>
    @livewireScripts
    @yield('script')
    @stack('scripts')
    
</body>
</html>

<!DOCTYPE html>
<html>
<!-- Mirrored from colorlib.com/polygon/adminator/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Feb 2020 05:40:12 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <title>@yield('title')</title>
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }
    </style>
    <link href="{{asset('static/adminator/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom-css.css')}}" rel="stylesheet"/>
</head>

<body class="app">
<div id="loader">
    <div class="spinner"></div>
</div>
<script type="5de606cf9ea158205b08b173-text/javascript">
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>
<div>
    @include('admin.layouts.sidebar')
    <div class="page-container">
        @include('admin.layouts.header')
            @yield('pageContent')
        @include('admin.layouts.footer')
    </div>
</div>
<script type="5de606cf9ea158205b08b173-text/javascript" src="{{asset('static/adminator/vendor.js')}}"></script>
<script type="5de606cf9ea158205b08b173-text/javascript" src="{{asset('static/adminator/bundle.js')}}"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="5de606cf9ea158205b08b173-|49" defer=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('assets/js/admin-script.js')}}"></script>
</body>
<!-- Mirrored from colorlib.com/polygon/adminator/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Feb 2020 05:40:20 GMT -->

</html>

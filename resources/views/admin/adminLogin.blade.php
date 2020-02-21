<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Login</title>
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
<script type="b2a752f21daf248fccdb74ac-text/javascript">
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>

<div class="peers ai-s fxw-nw h-100vh">
    <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url({{asset('static/adminator/assets/static/images/bg.jpg')}})">
        <div class="pos-a centerXY">
            <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="{{asset('static/adminator/assets/static/images/logo.png')}}" alt=""></div>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
        <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
            {{--   This is the main login page form     --}}
            <form id="adminLogin" action="{{route('validateAdminLogin')}}">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label class="text-normal text-dark">Username <span class="field-required">*</span></label>
                <input type="text" name="userName" id="userName" class="form-control" placeholder="John Doe">
                <div class="error-messages" id="usernameError">usernameError</div>
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Password <span class="field-required">*</span></label>
                <input type="password" name="userPassword" id="userPassword" class="form-control" placeholder="Password">
                <div class="error-messages" id="userPasswordError">userPasswordError</div>
            </div>
            <div class="form-group">
                <div class="peers ai-c jc-sb fxw-nw">
                    <div class="peer">
                        <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                            <input type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer">
                            <label for="inputCall1" class="peers peer-greed js-sb ai-c"><span class="peer peer-greed">Remember Me</span></label>
                        </div>
                    </div>
                    <div class="peer">
                        <button type="submit" name="adminLoginBtn" id="adminLoginBtn" class="btn btn-primary">Login</button>
                    </div>
                </div>
               <center> <img src="{{asset('assets/images/loader/loader-icon.gif')}}" id="loaderIcon" style="display: none" ></center>
            </div>
        </form>
        {{--   //ends the form here    --}}
    </div>
</div>
<script type="b2a752f21daf248fccdb74ac-text/javascript" src="{{asset('static/adminator/vendor.js')}}"></script>
<script type="b2a752f21daf248fccdb74ac-text/javascript" src="{{asset('static/adminator/bundle.js')}}"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="b2a752f21daf248fccdb74ac-|49" defer=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{--<script> let baseUrl = "{{url('/')}}";</script>--}}
<script src="{{asset('assets/js/admin-script.js')}}"></script>
</body>
</html>

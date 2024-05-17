<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('frontend.layouts.head')
</head>
<body class="js">

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->

@yield('main-content')

</body>
<!-- Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/js/customLF.js')}}"></script>

<!-- Nice Select JS -->
<script src="{{asset('frontend/js/nicesellect.js')}}"></script>

<!-- Slicknav JS -->
<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>

<!-- Active JS -->
<script src="{{asset('frontend/js/active.js')}}"></script>
</html>

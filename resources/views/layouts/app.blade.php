<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset( '../imgs/logo.png')}}">
    <title>Herdades do Sol</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="{{asset( './assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('./assets/css/nucleo-svg.css')}} " rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/002da5e179.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}} " rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{asset('assets/css/custom.css')}} " rel="stylesheet" />
    <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css')}} " rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }} d-flex flex-column min-vh-100">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['login', 'register', 'recover-password']))
            @yield('content')
        @else
            @if (in_array(request()->route()->getName(), ['home']))
                <div></div>
            @elseif (!in_array(request()->route()->getName(), ['profile']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile']))
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg mt-0 flex-grow-1">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    @include('layouts.footers.footer')

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    @stack('js')
</body>

</html>

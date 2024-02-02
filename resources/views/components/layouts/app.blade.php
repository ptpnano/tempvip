{{-- https://material-dashboard-laravel.creative-tim.com/documentation/getting-started/installation.html?_ga=2.196763695.22834434.1706864546-662723754.1706864546 --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        @vite(['resources/css/app.css', 'resources/js/app.js', 'assets/css/nucleo-icons.css', 'assets/css/nucleo-svg.css','assets/css/material-kit.css?v=3.0.4',
        'assets/js/core/bootstrap.min.js','assets/js/plugins/perfect-scrollbar.min.js','assets/js/plugins/moment.min.js',
        'assets/js/plugins/choices.min.js'])
        {{-- assets/css/vendor.css --}}
        @livewireStyles 

        {{-- <script data-navigate-once src="bootstrap.min.js"></script>
        <script data-navigate-once src="material-kit.css"></script> --}}

        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">

        <title>
            Temp Mail, free email generator, disposable email, random email, temp email, temporary email, temp email generator, random email generator, email generator, 10 minute mail, free disposable temporary email service
        </title>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

        <!-- Nucleo Icons -->
        {{-- <link href="./assets/css/nucleo-icons.css" rel="stylesheet" /> --}}
        {{-- <link href="./assets/css/nucleo-svg.css" rel="stylesheet" /> --}}

        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

        <!-- CSS Files -->

        {{-- <link id="pagestyle" href="./assets/css/material-kit.css?v=3.0.4" rel="stylesheet" /> --}}

        <!-- Nepcha Analytics (nepcha.com) -->
        <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
        <!--<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>-->


        <!-- Theme JS -->
        {{-- <script src="./assets/js/material-kit-pro.min.js" type="text/javascript"></script> --}}

        <!--   Core JS Files   -->
        {{-- <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="./assets/js/plugins/moment.min.js"></script> --}}


        <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        {{-- <script src="./assets/js/plugins/nouislider.min.js"></script> --}}

        <!--  Plugin for the Carousel, full documentation here: http://jedrzejchalubek.com/  -->
        {{-- <script src="./assets/js/plugins/glidejs.min.js"></script> --}}

        <!--	Plugin for Select, full documentation here: https://joshuajohnson.co.uk/Choices/ -->
        {{-- <script src="./assets/js/plugins/choices.min.js" type="text/javascript"></script> --}}

        {{-- <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"> --}}

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            .min-vh-75 {
                min-height: 16vh !important;
            }
            a{
                border-bottom: 1px solid transparent;
            }
            a:focus,
            a:hover {
                color: #000!important;
                border-bottom: 1px solid #fff;
                text-decoration: none
            }
            .justify-between {
                justify-content: space-between;
            }
            .flex {
                display: flex;
            }
            .border-dashed {
                border-style: dashed;
            }
            .border-t {
                border-width: 0px;
                border-top-width: 1px;
            }
            .border-b {
                border-width: 0px;
                border-bottom-width: 1px;
            }
            .border-1 {
                border-width: 1px;
            }
        </style>

        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="index-page bg-gray-200">
        @include('layouts.header')
        {{-- {{ $slot }} --}}
        {{-- {{ session('status') }} --}}
        @livewire('accounts-controller')
        @livewireScripts 
        @include('layouts.footer')
    </body>
</html>

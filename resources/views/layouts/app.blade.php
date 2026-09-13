<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-theme="theme-default"
    data-assets-path="../../../front_assets/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Bootstrap CSS CDN -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> --}}
    <!-- Our Custom CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}"> --}}

    {{-- <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/function.js') }}"></script>
    <script src="{{ asset('js/Tc/main.js') }}"></script>

    <script src="{{ asset('js/lib/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/lib/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/lib/helpers.js') }}"></script> --}}

    <!-- Font Awesome JS -->
    {{-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script> --}}


    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
     <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans:400,500,700">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('js/lib/fontawesome-pro/css/all.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/lib/DataTables/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/lib/DataTables/jquery-datatable.css')}}"/> --}}


    <!-- Styles MODIFICADOS PARA FREST - Jaen -->
    <!-- Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('front_assets/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('front_assets/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('front_assets/assets/vendor/fonts/flag-icons.css') }}" /> --}}

    <!-- Core CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('front_assets/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('front_assets/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('front_assets/assets/css/demo.css') }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('front_assets/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
--}}
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- Jaen Page CSS, js  -->
    <!-- Font Awesome JS -->
    {{-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script> --}}

</head>

<body>
    <div id="app" class="wrapper">
        @if (Auth::check())
            @include('partials.nav')
            @include('layouts.sidebar')
        @endif
        <div id="content">
            @if (Auth::check())
             @include('layouts.sidehead')
            @endif
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <header>
            @include('modals.modalSuccess')
            @include('modals.modalLoading')
            @include('modals.modalDelete')
            @include('partials.validation-errors')
        </header>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/function.js') }}"></script>
    <script src="{{ asset('js/Tc/main.js') }}"></script>
    <script src="{{asset('js/lib/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/lib/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/lib/fontawesome-pro/js/all.min.js')}}"></script>
    <script src="{{asset('js/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('js/lib/helpers.js') }}"></script>

    @yield('script')
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../../../front_assets/assets/"
    data-template="vertical-menu-template"
    >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans:400,500,700">

   
     <!-- Styles MODIFICADOS PARA FREST - Jaen -->

 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="{{asset('front_assets/assets/img/favicon/favicon.ico')}}" />

 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link
   href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
   rel="stylesheet"
 />

 <!-- Icons -->
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/fonts/boxicons.css')}}" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/fonts/fontawesome.css')}}" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/fonts/flag-icons.css')}}" />

 <!-- Core CSS -->
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/css/demo.css')}}" />

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
 <link rel="stylesheet" href="{{asset('front_assets/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

 <!-- Page CSS -->

 <!-- Helpers -->
 <script src="{{asset('front_assets/assets/vendor/js/helpers.js')}}"></script>

 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
 <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
 <script src="{{asset('front_assets/assets/vendor/js/template-customizer.js')}}"></script>
 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
 <script src="{{asset('front_assets/assets/js/config.js')}}"></script>
     <!-- FIN Styles MODIFICADOS PARA FREST - Jaen -->
</head>
<body>
    <div id="app">

        <header>
            @include('partials.nav')
            @include('modals.modalSuccess')
            @include('modals.modalLoading')
            @include('modals.modalDelete')
            @include('modals.modalDeleteFactura')
            @include('partials.validation-errors')
        </header>

        <main class="py-4">
            @yield('content')
            <div id="frame">

            </div>
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/function.js') }}"></script>
    <script src="{{ asset('js/Tc/main.js') }}"></script>

    <script src="{{asset('js/lib/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/lib/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/lib/moment/min/moment.min.js')}}"></script>

    @yield('script')


    <!-- MODIFICADO PARA FREST TEMPLATE/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('front_assets/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('front_assets/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('front_assets/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('front_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('front_assets/assets/vendor/libs/hammer/hammer.js')}}"></script>

    <script src="{{asset('front_assets/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('front_assets/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

    <script src="{{asset('front_assets/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('front_assets/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('front_assets/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('front_assets/assets/js/dashboards-analytics.js')}}"></script>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('js/lib/fontawesome/css/all.css') }}" rel="stylesheet">
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
</body>
</html>

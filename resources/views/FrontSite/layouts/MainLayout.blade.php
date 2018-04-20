<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('jquery/jquery-3.2.1.min.js') }}"></script>
</head>
<body>
    <div class="container-fluid">
        @include('FrontSite.layouts.navbar');
        <div class="content">
            <div class="row" style="margin-top: 176px">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            @include('FrontSite.layouts.Footer');
        </footer>
        <form id="ref-form" method="post">
        {{ csrf_field() }}
    </form>
    </div>
</body>
<!-- Scripts -->
    
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function(e){
        $('a[data-method="logout"]').on('click',function(e){
            e.preventDefault();
            $('#logout-form').submit();
        })
    })
</script>
</html>

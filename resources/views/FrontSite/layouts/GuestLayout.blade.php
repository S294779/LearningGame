<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('FrontSite/css/theme.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
        
<!--        <script src="{{ asset('plugins/phaser-ce-2.10/phaser.min.js') }}"></script>
        <script src="{{ asset('FrontSite/js/welcome.js') }}"></script>-->
    </head>
    <body>
        <div class="container-fluid custome-theme no-padding" style="background-image: none">            
            <div class="content col-xs-12" style="margin-top:0px">
                    @yield('content')
            </div>            
        </div>
        
    </body>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('FrontSite/js/common.js') }}"></script>
    <script>
$(document).ready(function (e) {
    $('a[data-method="logout"]').on('click', function (e) {
        e.preventDefault();
        $('#logout-form').submit();
    })
})
    </script>
</html>

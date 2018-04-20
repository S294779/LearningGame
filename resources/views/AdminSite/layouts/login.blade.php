<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>
        <!-- Styles -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('custom-font-icon/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminSite/css/common.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    </head>
    <body >
        
        <div class="full-screen-cover">
            @yield('content')
        </div>
        <div class="overlay">
            <i class="fa fa-spinner9"></i>
        </div>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>

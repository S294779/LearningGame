<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@Yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.7 -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminSite/css/AdminLTE.modi.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/fileinput.min.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminSite/css/common.css') }}" rel="stylesheet">

        <!-- jQuery 3 -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <style>


        </style>
    </head>
    <body class="hold-transition skin-green sidebar-mini" id="layout-body">
        <script>
            var elmt = document.getElementById('layout-body');
            elmt.setAttribute('class', 'skin-green sidebar-mini ' + localStorage.getItem('minimize-side-bar'));
        </script>
        <div class="wrapper">

            @include('AdminSite.layouts.topBar')
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                @include('AdminSite.layouts.leftside')
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/admin')}}">Home</a></li>
                        @yield('breadcrumb')
                    </ul>
                    @if(session()->has('success'))
                    <div class="alert-success alert fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!! session('success') !!}
                    </div>
                    @endif
                    @if(session()->has('danger'))
                    <div class="alert-danger alert fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!! session('danger') !!}
                    </div>
                    @endif
                    @if(session()->has('warning'))
                    <div class="alert-warning alert fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!! session('warning') !!}
                    </div>
                    @endif
                    @if(session()->has('info'))
                    <div class="alert-info alert fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!! session('info') !!}
                    </div>
                    @endif
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->


        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('AdminSite/js/menu_active.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('AdminLTE/dist/js/demo.modi.js') }}"></script>
        <script src="{{ asset('bootstrap/js/fileinput.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        
        <script src="{{ asset('plugins/tinymce/js/tinymce.init.js') }}"></script>
        
        <script src="{{ asset('AdminSite/js/common.js') }}"></script>
        
    </body>

</html>

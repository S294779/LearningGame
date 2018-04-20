<header class="main-header">
    <!-- Logo -->
    <a href="{{url(Config::get('constants.admin_prefix'))}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle fa fa-bars" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @php
                            $profile_dir = App\Modules\Admins\Models\AdminManage::FILE_DIR;
                            $profile_size_mini = App\Modules\Admins\Models\AdminManage::PROFILE_ICON_SIZE_MINI;
                            $profile_pic = Auth::guard('admin')->user()->profile_pic;
                            $profile_path = $profile_pic?url(Config::get('constants.admin_prefix').'/file-source',$profile_dir.'.'.$profile_size_mini.'.'.$profile_pic):url(Config::get('constants.admin_prefix').'/file-source','default-profile.png');
                        @endphp
                        <img src="{{$profile_path}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @php
                                $profile_size_med = App\Modules\Admins\Models\AdminManage::PROFILE_ICON_SIZE_MEDIUM;
                                $profile_path = $profile_pic?url(Config::get('constants.admin_prefix').'/file-source',$profile_dir.'.'.$profile_size_med.'.'.$profile_pic):url(Config::get('constants.admin_prefix').'/file-source','default-profile.png');
                            @endphp
                            <img src="{{$profile_path}}" class="img-circle" alt="User Image">

                            <p>
                                
                                {{Auth::guard('admin')->user()->name}}- Admin
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url(Config::get('constants.admin_prefix').'/administration/profile') }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url(Config::get('constants.admin_prefix').'/logout') }}" data-method="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
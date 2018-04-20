             <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">
                    @php
                        $profile_dir = App\Modules\Admins\Models\AdminManage::FILE_DIR;
                        $profile_size_mini = App\Modules\Admins\Models\AdminManage::PROFILE_ICON_SIZE_MINI;
                        $profile_pic = Auth::guard('admin')->user()->profile_pic;
                        $profile_path = $profile_pic?url(Config::get('constants.admin_prefix').'/file-source',$profile_dir.'.'.$profile_size_mini.'.'.$profile_pic):url(Config::get('constants.admin_prefix').'/file-source','default-profile.png');
                    @endphp
                  <img src="{{$profile_path}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p>Alexander Pierce</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>
              <!-- search form -->
              <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
              <!-- /.search form -->
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu tree" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                  <a href="#" data-id="71" data-parentid="0">
                    <i class="fa fa-gamepad"></i> <span>Phaser Game</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="">
                      <a href="{{url(Config::get('constants.admin_prefix').'/phaser-game')}}" data-id="72" data-parentid="71" style="display: block;">
                        <i class="icon icon-picture-o"></i> <span>All games</span>
                      </a>
                    </li>
                    <li class="">
                      <a href="{{url(Config::get('constants.admin_prefix').'/phaser-game/create')}}" data-id="73" data-parentid="71">
                        <i class="icon icon-users"></i> <span>New Game</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" data-id="10" data-parentid="0">
                    <i class="fa fa-user"></i> <span>Student Mgnt</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="">
                      <a href="{{url(Config::get('constants.admin_prefix').'/user-manage/newuser')}}" data-id="69" data-parentid="10">
                        <i class="icon icon-user-plus"></i> <span>New Student</span>
                      </a>
                    </li><li class="">
                      <a href="{{url(Config::get('constants.admin_prefix').'/user-manage/allusers')}}" data-id="70" data-parentid="10">
                        <i class="icon icon-users"></i> <span>All Students</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" data-id="80" data-parentid="0">
                    <i class="fa fa-list"></i> <span>Game Result</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="">
                      <a href="{{url(Config::get('constants.admin_prefix').'/game-result')}}" data-id="81" data-parentid="80">
                        <i class="icon icon-picture-o"></i> <span>All games Result</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </section>           
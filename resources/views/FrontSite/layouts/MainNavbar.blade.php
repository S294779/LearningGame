@php
$langs = [
    'en'=>'English',
    'nep'=>'Nepali'
];
@endphp
<nav class="navbar navbar-default custome-style navbar-fixed-top">
    <div class="container_bkup">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <a href="{{url('/')}}"><img class="img-responsive" src="{{asset('images/logo/logo.png')}}"></a>
                </div>
                <div class="col-sm-9">
                    <div class="row" id="select-language-container1" >
                        <div class="col-sm-3 col-sm-offset-9">
                            @php
                                $params = '';
                                foreach($_GET as $g_key=>$g_val){
                                    if($params == ''){
                                        $params .= '?'.$g_key.'='.$g_val;
                                    }else{
                                        $params .= '&'.$g_key.'='.$g_val;
                                    }

                                }
                            @endphp
                            <select class="form-control sakyan-select-language" name="select-language" data-seturl="{{url('/set-lang')}}" data-currentpath="{{Route::getFacadeRoot()->current()->uri()}}" data-params = "{{$params}}">
                                @php
                                    foreach($langs as $lang=>$name){
                                        $selected = '';
                                        if($lang == app()->getLocale()){
                                            $selected = 'selected';
                                        }
                                @endphp
                                <option value="{{$lang}}" {{$selected}} >{{$name}}</option>
                                @php
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container_bkup">
        <div class="row" style="margin-top: 10px">
            <div class="col-sm-12">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle pull-left" style="margin-left: 15px" data-toggle="collapse" data-target="#custom-id">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <div id="select-language-container2" style="width: calc(100% - 90px); padding-top: 10px ! important; float: left">
                            <select class="form-control sakyan-select-language" name="select-language" data-seturl="{{url('/set-lang')}}" data-currentpath="{{Route::getFacadeRoot()->current()->uri()}}" data-params = "{{$params}}">
                                @php
                                    foreach($langs as $lang=>$name){
                                    $selected = '';
                                    if($lang == app()->getLocale()){
                                    $selected = 'selected';
                                    }
                                    @endphp
                                    <option value="{{$lang}}" {{$selected}} >{{$name}}</option>
                                    @php
                                    }
                                @endphp
                            </select>
                        </div>                         
                    </div>
                    <div class="collapse navbar-collapse " id="custom-id">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{url('/')}}">Home</a></li>
<!--                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Page 1-1</a></li>
                                    <li><a href="#">Page 1-2</a></li>
                                    <li><a href="#">Page 1-3</a></li>
                                </ul>
                            </li>-->
                            <li><a href="{{url('/about')}}">About Us</a></li>
                            <li><a href="{{url('/contact')}}">Contact Us</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}" data-method="logout">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

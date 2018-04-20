@php
$langs = [
'en'=>'English',
'nep'=>'Nepali'
];
@endphp
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle pull-right" style="margin-left: 15px" data-toggle="collapse" data-target="#custom-id">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="{{url('/')}}">Welcome</a>
        </div>
        <div class="collapse navbar-collapse " id="custom-id">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/game-list')}}">Games</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
<!--                <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
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

</nav>

@extends('AdminSite.layouts.login')
@section('content')
<div class="container">
    <div class="row" style="margin-top: 20%">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-success">
                <div class="panel-heading" style="text-align: center; font-size: 20px;">
                    <span>Welcome</span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/'.Config::get('constants.admin_prefix').'/login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="email" type="email" placeholder="Email Address" class="form-control " name="email" value="{{ old('email') }}" autofocus>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="password" placeholder="Password" type="password" class="form-control " name="password">

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>
                                </div>
                                <!--                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>-->
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>   
    </div>
</div>
@endsection

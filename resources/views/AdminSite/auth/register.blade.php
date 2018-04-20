@extends('layouts.frontsite')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        <h2 style="text-align: center">Please Register</h2>
                        <hr>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Name" class="form-control input-lg" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="Email Address" class="form-control input-lg" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control input-lg" placeholder="Password" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control input-lg" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block btn-lg">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                    <center><b>Already registered ?</b> <br><a href="{{url('/login')}}">Login here</a></center>
                
        </div>
    </div>
</div>
@endsection

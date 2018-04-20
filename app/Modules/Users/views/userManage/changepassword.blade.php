@extends('AdminSite.layouts.main')
@section('title')
Changing password
@endsection
@section('breadcrumb')
<li><a class="disabled" href="#">Change Password</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Password change Form</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="{{url(Config::get('constants.admin_prefix').'/user-manage/changepass')}}" method="post">
                            {{ csrf_field() }}
                            @php
                            $all_field_error = $errors->any()?'has-success':'';
                            @endphp
                            <div class="form-group {{ $errors->has('current_password') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">Current Password</label>
                                <input class="form-control" type="password" name="current_password" value="{{ old('current_password') }}">
                                @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('new_password') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">New Password</label>
                                <input class="form-control" type="password" name="new_password" value="{{ old('new_password') }}">
                                @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('new_password_confirmation') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">Confirm New Password</label>
                                <input class="form-control" type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                @if ($errors->has('new_password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" value="pass">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
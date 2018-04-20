@extends('AdminSite.layouts.main')
@section('title')
{{($model->id)?'Updating user': 'Adding New User' }}
@endsection
@section('breadcrumb')
<li><a class="" href="{{url(Config::get('constants.admin_prefix').'/user-manage/allusers')}}">All Users</a></li>
<li><a class="disabled" href="#">{{($model->id)?'Updating user': 'Adding New User' }}</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">{{($model->id)?'Updating user': 'Adding New User' }}</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{($model->id)?url(Config::get('constants.admin_prefix').'/user-manage/updateuser',$model->id): url(Config::get('constants.admin_prefix').'/user-manage/newuser') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @php
                            
                            $all_field_error = $errors->any()?'has-success':'';
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('profilepic') ? ' has-error' :$all_field_error}}">
                                        <label class="control-label">Profile Pic</label>
                                        
                                        @php
                                        
                                            $dir_name = App\Modules\Users\Models\UserManage::FILE_DIR;
                                            $image_size = App\Modules\Users\Models\UserManage::PROFILE_ICON_SIZE_MEDIUM;
                                            
                                            $file_name = $model->profile_pic?$model->profile_pic:'';
                                            $file_path = $file_name?url($dir_name.'/'.$image_size.'/'.$file_name):url('/file-source','default-profile.png');
                                        @endphp
                                        
                                        <input class="form-control file-input" type="file" name="profilepic" data-value="{{$file_path}}" data-extensions="jpg,png">
                                        @if ($errors->has('profilepic'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profilepic') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' :$all_field_error}}">
                                        <label class="control-label">Name</label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name',$model->name) }}">
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
<!--                                    <div class="form-group {{ $errors->has('email') ? ' has-error' :$all_field_error}}">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email',$model->email) }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>-->
                                    <div class="form-group {{ $errors->has('status') ? ' has-error' :$all_field_error}}">
                                        <label class="control-label">Status</label>
                                        <select class="form-control select-status" name="status">
                                            
                                            @foreach(App\Models\User::getStatus() as $status_key=>$status)
                                            @php
                                            
                                                $status_sel = '';
                                                if($status_key == $model->status){
                                                    $status_sel = 'selected';
                                                }
                                            @endphp
                                            <option {{$status_sel}} value="{{$status_key}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    @if(!$model->id)
                                        <div class="form-group {{ $errors->has('password') ? ' has-error' :$all_field_error}}">
                                            <label class="control-label">Password</label>
                                            <input class="form-control" type="password" name="password" value="{{ old('password',$model->password) }}">
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' :$all_field_error}}">
                                            <label class="control-label">Conform Password</label>
                                            <input class="form-control" type="password" name="confirm_password" value="{{ old('confirm_password',$model->confirm_password) }}">
                                            @if ($errors->has('confirm_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
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
<script>
    $(document).ready(function(e){
        $('.select-roles').select2({
            placeholder:'Select Roles'
        }) 
        $('.select-status').select2({
            placeholder:'Select Status'
        }) 
    })
    
</script>
@endsection
@extends('FrontSite.layouts.consultancytLayout')
@section('content')
@php
$dir_name = App\Modules\Consultancy\Models\AbroadCountry::FILE_DIR_form_img;
$image_size = App\Modules\Consultancy\Models\AbroadCountry::ENQUIRY_IMG_SIZE;
@endphp
<style>
    .query-panel-heading{
        color: #000;
        background-color: rgba(56, 146, 50, 0.35) ! important;
        font-weight: bold;
    }
    .background-consultancy{
        background-image: url("{{url('file-source/'.$dir_name.'.'.$image_size.'.'.$selected_country->enquiry_form_image)}}");
        background-size: 100% 100%;
    }
    .enquiry-panel{
            background-color: rgba(255, 255, 255, 0.82);
    }
    .enquiry-row{
            background: rgba(255, 255, 255, 0);
    }
    .enquiry-panel input, .enquiry-panel select, .enquiry-panel textarea{
        background-color: rgba(255, 255, 255, 0.25) ! important;
        color:#000
    }
    .enquiry-panel select option{
        color:#000
    }
</style>
<div class="row enquiry-row" style="padding-top:20px">
    <div class="container">
        <div class="panel panel-default enquiry-panel">
            <div class="panel-heading query-panel-heading">{{trans('Enquiry Form')}}</div>
            <div class="panel-body">
                <form method="post" action="{{url('consultancy-enquiry').'/'.app()->getLocale().'/'.$selectedCountry}}">
                    {{csrf_field()}}
                    @php
                    $all_field_error = $errors->any()?'has-success':'';
                    @endphp
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Name')}}<span class="imp-indicator">*</span></label>
                                <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Email')}}</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('phone') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Phone')}}<span class="imp-indicator">*</span></label>
                                <input type="text" name="phone" required class="form-control" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('last_education') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Your Last Education')}}</label>
                                <select name="last_education" class="form-control lst-edu">
                                    <option value=""></option>
                                    @foreach($lastEducations as $lastEducation)
                                    @php
                                    $selected_edu = '';
                                    if(old('last_education')){
                                    if($lastEducation->last_education == old('last_education')){
                                    $selected_edu = 'selected';
                                    }
                                    }
                                    @endphp
                                    <option {{$selected_edu}} value="{{$lastEducation->last_education}}">{{$lastEducation->last_education}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('last_education'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_education') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('passed_year') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Passed Year')}}</label>
                                <select name="passed_year" class="form-control passed_yr">
                                    <option value=""></option>
                                    @foreach($passed_yrs as $passed_yr)
                                    @php
                                    $selected_year = '';
                                    if(old('passed_year')){
                                    if($passed_yr == old('passed_year')){
                                    $selected_year = 'selected';
                                    }
                                    }
                                    @endphp
                                    <option {{$selected_year}} value="{{$passed_yr}}">{{$passed_yr}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('passed_year'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('passed_year') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' has-error' :$all_field_error}}">
                                <label class="control-label">{{trans('Your Address')}}</label>
                                <textarea name="address" rows="4" class="form-control">{{old('address')}}</textarea>
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                @php
                                    $_city = (int)$selected_country->city_basis;
                                    $_univ = (int)$selected_country->university_basis;
                                    $total = $_city + $_univ;
                                    
                                    if($total>0){
                                        $colSize = 12/$total;
                                    }else{
                                        $colSize = 'hidden';
                                    }
                                    
                                @endphp
                                @if($_city)
                                <div class="col-sm-{{$colSize}}">
                                    @php
                                        $only_one_time = true;
                                    @endphp
                                    @foreach($selected_country->cities as $city)
                                        @if($only_one_time == true)
                                        <div class="form-group">
                                            <h4 style="text-decoration: underline">{{trans('Choose your city')}}</h4>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="control-label">
                                                    @php
                                                        $select_city = '';
                                                        if(old('cities') != null){
                                                            if(in_array($city->id,old('cities'))){
                                                                $select_city = 'checked';
                                                            }
                                                        }
                                                    @endphp
                                                    <input {{$select_city}} type="checkbox" name="cities[]" value="{{$city->id}}">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    {{$city->city_name}}
                                                </label>
                                            </div>
                                        </div>
                                        @php
                                            $only_one_time = false;
                                        @endphp
                                    @endforeach
                                </div>
                                @endif
                                @if($_univ)
                                <div class="col-sm-{{$colSize}}">
                                    @php
                                        $only_one_time = true;
                                    @endphp
                                    @foreach($selected_country->universities as $university)
                                        @if($only_one_time == true)
                                        <div class="form-group">
                                            <h4 style="text-decoration: underline">{{trans('Choose your university')}}</h4>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="control-label">
                                                    @php
                                                        $select_univ = '';
                                                        if(old('universities') != null){
                                                            if(in_array($university->id,old('universities'))){
                                                                $select_univ = 'checked';
                                                            }
                                                        }
                                                    @endphp
                                                    <input {{$select_univ}} type="checkbox" name="universities[]" value="{{$university->id}}" >
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    {{$university->university_name}}
                                                </label>
                                            </div>
                                        </div>
                                       @php
                                        $only_one_time = false;
                                    @endphp 
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{trans('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (e) {
        $('.lst-edu').select2({
            placeholder: "Select Last Education"
        })
        $('.country-select').select2({
            placeholder: "Select Country"
        })
        $('.passed_yr').select2({
            placeholder: "Select Passed Year"
        })
        $(window).resize(function(){
            $('.lst-edu').select2({
            placeholder: "Select Last Education"
            })
            $('.country-select').select2({
                placeholder: "Select Country"
            })
            $('.passed_yr').select2({
                placeholder: "Select Passed Year"
            })
        })
    })
</script>
@endsection
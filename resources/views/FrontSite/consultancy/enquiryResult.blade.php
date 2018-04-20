@extends('FrontSite.layouts.consultancytLayout')
@section('content')
<link href="{{ asset('css/textColorAnimate.css') }}" rel="stylesheet">
<style>
    .query-panel-heading{
        color: #000;
        background-color: rgba(56, 146, 50, 0.35) ! important;
        font-weight: bold;
    }
    .background-consultancy{
        background-image: url("{{url('file-source/'.$selected_country->enquiry_form_image)}}");
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
            <div class="panel-heading query-panel-heading">{{trans('Enquiry Result')}}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{url('consultancy-enquiry/'.app()->getLocale())}}" class="btn btn-primary">{{trans('Back To Form')}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 style="text-decoration: underline">{{trans('Results')}}</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach($messages as $message)
                    <div class="col-sm-12 awesome" style="font-weight: bold">
                        {{$message}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
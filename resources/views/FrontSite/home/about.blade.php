@extends('FrontSite.layouts.guestLayout')

@section('content')

<div class="row">
    <div class="container">
        <div class="col-sm-12">
            <h4>{{trans('About')}}</h4>
        </div>
        <div class="col-sm-12 text-justify">
            @if($model)
            {!!$model->description,''!!}
            @endif
        </div>
    </div>
</div>
@endsection
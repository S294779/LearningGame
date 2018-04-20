@extends('FrontSite.layouts.GuestLayout')

@section('title')
Welcome
@endsection
@section('content')

<div class="row">
    <div class="col-sm-12" style="text-align: center">
        <iframe  allowtransparency="true" style="background: #FFFFFF;" src="{{url('/alphabet-drowing-game/canvas-path')}}" width="80%" height="668"  frameborder="0" allowfullscreen scrolling="no"></iframe>
    </div>
 </div>

@endsection
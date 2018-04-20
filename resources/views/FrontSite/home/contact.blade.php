@extends('FrontSite.layouts.guestLayout')
@section('content')
@php
$setting = new App\Modules\Setting\Models\Setting;
@endphp
<div class="row">
    <div class="container">
        <div class="col-sm-12">
            <h3>{{trans('Contact')}}</h3>
        </div>
        <div class="col-sm-6 text-justify contact-text">
            <p><b>{{trans($setting->getSettingByCode('[GEN]_COMP_ORG_NAME'))}}</b></p>
            <p>Location: {{trans($setting->getSettingByCode('[GEN]_COMP_ORG_ADDRESS'))}}</p>
            <p>Mobile: <a href="tel:{{$setting->getSettingByCode('[GEN]_COMP_ORG_PHONE')}}">{{$setting->getSettingByCode('[GEN]_COMP_ORG_PHONE')}}</a></p>
            <p>Email: <a href="mailto:{{$setting->getSettingByCode('[GEN]_COMP_ORG_EMAIL')}}">{{$setting->getSettingByCode('[GEN]_COMP_ORG_EMAIL')}}</a></p>
        </div>
        <div class="col-sm-6">
            <p><b>{{trans('Map')}}</b></p>
            @php
            $lat_lng = explode(',',$setting->getSettingByCode('[GEN]_COMP_ORG_MAP'));
            @endphp
            <div id="map" style="height: 300px;margin-top: 20px"></div>
            <script>
                function initMap() {

                var uluru = {lat: {{$lat_lng[0]}}, lng: {{$lat_lng[1]}}};
                        var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 12,
                                center: uluru,
                        });
                        var marker = new google.maps.Marker({
                                position: uluru,
                                     map: map
                        });
                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgXA-yAmXd6w6M5FcavMEJkfVT56gVJ4w&callback=initMap">
            </script>
        </div>
    </div>
</div>
@endsection
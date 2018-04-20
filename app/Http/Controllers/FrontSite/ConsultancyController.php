<?php

namespace App\Http\Controllers\FrontSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Consultancy\Models\LastEducation;
use App\Modules\Consultancy\Models\AbroadCountry;
use App\Models\Enquiry;
use App\Modules\Consultancy\Models\AbroadCity;
use App\Modules\Consultancy\Models\AbroadUniversity;

class ConsultancyController extends Controller {

    public function enquiry(Request $request,$locale = null,$selectedCountry = null) {
        
        $selected_country = AbroadCountry::query()->select('id')->where(['name'=>$selectedCountry])->first();
        if($selected_country  == null){
            $selectedCountry = 'japan';
        }
        $selected_country = AbroadCountry::query()->where(['name'=>$selectedCountry])->first();
        
        $lastEducations = LastEducation::query()->get();

        $initial_year = date_create('2009-01-01');

        $current_date = date_create(date('Y-m-d'));
        $date_diff = $current_date->diff($initial_year);
        $year_collection = [];
        while ($date_diff->invert == 1) {
            $year_collection[] = $initial_year->format('Y');
            date_modify($initial_year, '+1 year');
            $date_diff = $current_date->diff($initial_year);
        };
        $countries = AbroadCountry::query()->get();
        
        return view('FrontSite.consultancy.enquiryForm', [
            'lastEducations' => $lastEducations,
            'passed_yrs' => $year_collection,
            'countries' => $countries,
            'selectedCountry' => $selectedCountry,
            'selected_country' => $selected_country,
        ]);
    }

    public function result(Request $request,$locale = null,$selectedCountry = null) {
        $model = new Enquiry;
        if($request->isMethod('post') && !$this->validate($request,  $model->validate_enquiry)){
            $selected_country = AbroadCountry::query()->where(['name'=>$selectedCountry])->first();
            if($selected_country  == null){
                $selectedCountry = 'japan';
            }
            $requested_data = $request->all();
            $cities = isset($requested_data['cities'])?  implode(',', $requested_data['cities']):'';
            $universities = isset($requested_data['universities'])?  implode(',',$requested_data['universities']):'';
            $abroad_country = AbroadCountry::query()->where(['name'=>$selectedCountry])->first();
            //saving data
            $model->name = $requested_data['name'];
            $model->phone = $requested_data['phone'];
            $model->email = isset($requested_data['email'])?$requested_data['email']:'';
            $model->last_education = isset($requested_data['last_education'])?$requested_data['last_education']:'';
            $model->passed_year = isset($requested_data['passed_year'])?$requested_data['passed_year']:'';
            $model->address = isset($requested_data['address'])?$requested_data['address']:'';
            $model->enquiry_at = date('Y-m-d H:i:s');
            $model->cities = $cities;
            $model->universities = $universities;
            $model->country_id = $abroad_country->id;
            
            $model->save();
            
            /*descision start*/
            
            $last_education = LastEducation::query()->where(['country'=>$abroad_country->country_id,'last_education'=>$requested_data['last_education']])->first();
            
            $initial_year = date_create($requested_data['passed_year'].'-01-01');
            $current_date = date_create(date('Y-m-d'));
            $date_diff = $current_date->diff($initial_year);
            
            
            if($date_diff->y > 8){
                $messages = [
                    "If you want to apply for $selectedCountry then you have to give proper reason. We will contact you soon."
                ];
            }elseif($date_diff->y > 0){
                $messages = [
                    "you are able to apply for $selectedCountry. We will contact you soon."
                ];
            }
            if(!isset($messages)){
                $messages = [
                    "If you want to apply for $selectedCountry then you have to give proper reason. We will contact you soon."
                ];
            }
            /*descision stop*/
            
            $countries = AbroadCountry::query()->get();
            
            return view('FrontSite.consultancy.enquiryResult', [
                'messages'=>$messages,
                'countries' => $countries,
                'selectedCountry' => $selectedCountry,
                'selected_country' => $selected_country,
            ]);
        }
    }

}

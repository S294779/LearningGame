<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Enquiry extends Authenticatable
{
    use Notifiable;
    
    
    protected $table = 'consult_enquiry';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $timestamps = false;
    
    public $rules = [
        'name'=>'required|string',
        'email'=>'required|email',
        'phone'=>'required|integer',
        'last_education'=>'required|string',
        'passed_year'=>'required|string',
        'address'=>'required|string',
        'country_id'=>'required|integer',
        'universities'=>'required',
        'cities'=>'required',
    ];


    public $validate_enquiry = [
            'name'=>'required|string',
            'phone'=>'required|integer',
        ];
    public $validate_enquiry2 = [
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|integer',
            'last_education'=>'required|string',
            'passed_year'=>'required|string',
            'address'=>'required|string',
        ];
}

<?php
namespace App\Modules\Api_token\Models;
use Illuminate\Database\Eloquent\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppTokenCollection extends Model{
    
    protected $table = 'sys_app_token_collection';
    
    protected $filliable = [
        
    ];
    
    public static function generate_token(){
        
        return str_random(64);
    }
    
    
}
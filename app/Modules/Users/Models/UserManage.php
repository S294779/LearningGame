<?php
namespace App\Modules\Users\Models;
use Illuminate\Database\Eloquent\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserManage extends Model{
    
    const FILE_DIR = 'user-profile';
    
    const PROFILE_ICON_SIZE_MINI = '160X160';
    const PROFILE_ICON_SIZE_MEDIUM = '300X300';
    const PROFILE_ICON_SIZE_LARGE = '600X600';
    
    public static function getImageSizes(){
        return[
                self::PROFILE_ICON_SIZE_MINI,
                self::PROFILE_ICON_SIZE_MEDIUM,
                self::PROFILE_ICON_SIZE_LARGE,
            ];
    }
    protected $table = 'sys_users';
    
    protected $filliable = [
        'name',
        'email',
        'password',
        'remember_token',
        'status',
        'created_at',
        'updated_at'
    ];
    
    public $user_manage_rules = [
        'name'=>'required|string|min:1',
        //'email'=>'required|email',
        'password'=>'required|string|min:6',
        'confirm_password' => 'required|same:password',
        'status' => 'required|integer',
        'profilepic' => 'required',
    ];
    public $user_manage_rules_update = [
        'name'=>'required|string|min:1',
        //'email'=>'required|email',
        'status' => 'required|integer',
    ];
    
    public function roles(){
        return $this->hasMany('App\Modules\Users\Models\AuthAssignment','user_id','id');
    }
    
    public function token(){
        return $this->hasOne('App\Modules\Users\Models\UserToken','user_id','id');

    }
}
<?php

namespace App\Modules\PhaserGame\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhaserApiLogin extends Model {
	
    
	public static function api_login_rules(){
		return [
			'student_id'=>'required',
			'profile_pic'=>'required',
		];
	}
        public static function general_rules_after_login(){
            return [
			'game_id'=>'required',
			'user_token'=>'required',
		];
        }


}
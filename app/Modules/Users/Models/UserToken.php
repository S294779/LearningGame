<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Api_token\Models\AppTokenCollection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserToken extends Model {

    protected $table = 'sys_user_token';
    public $timestamps = false;

    public static function validate_user_token($token) {
        $model = self::query()
                ->where(['user_token' => $token])
                ->first();
        if ($model) {
            $new_token = AppTokenCollection::generate_token();
            $model->user_token = $new_token;
            if ($model->save()) {
                return $new_token;
            }
            return false;
        }
        return false;
    }

    public static function get_user_by_token($token) {
        $model = self::query()
                ->where(['user_token' => $token])
                ->first();

        if ($model) {
            return $model->user_id;
        } else {
            return false;
        }
    }

    public static function renew_token_with_id($user_id) {
        $model = self::query()
                ->where(['user_id' => $user_id])
                ->first();
        if ($model) {
            $new_token = AppTokenCollection::generate_token();
            $model->user_token = $new_token;
            if ($model->save()) {
                return $new_token;
            }
            return false;
        }
        return false;
    }

}

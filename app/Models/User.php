<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'sys_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function getStatus(){
        return[
            self::STATUS_ACTIVE=>'Active',
            self::STATUS_INACTIVE=>'Inactive',
        ];
    }

}

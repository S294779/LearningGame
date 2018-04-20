<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot() {
        $this->app['validator']->extend('custom_rule', function ($attribute, $value, $parameters) {
            if(isset($parameters[0])){
                return $parameters[0](Request::all());
            }
            return false;
        });
    }

}

<?php

namespace App\Modules\Api_token\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Modules\Api_token\Models\AppCollection;
use App\Modules\Api_token\Models\AppTokenCollection;

class TokenController extends Controller {

    private $errors = array();
    private $app_id = 0;

    public function __construct(Request $request) {
        $posted_data = $request->all();

        if (!isset($posted_data['grant_type'])) {
            $this->errors[] = 'grant_type is missing.';
        } else {
            if ($posted_data['grant_type'] != 'client_credentials') {
                $this->errors[] = 'support grant_type only client_credentials.';
            }
        }
        if (!isset($posted_data['client_secret'])) {
            $this->errors[] = 'client_secret is missing.';
        }
        if (!isset($posted_data['client_id'])) {
            $this->errors[] = 'client_id is missing.';
        }
        if (empty($this->errors)) {
            $app_model = AppCollection::query()
                    ->where(['client_id' => $posted_data['client_id'], 'client_secret' => $posted_data['client_secret']])
                    ->first();

            if ($app_model) {
                $this->app_id = $app_model->id;
            } else {
                $this->errors[] = 'client_id or client_secret not matched.';
            }
        }
    }

    public function index(Request $request) {
        if (!empty($this->errors)) {
            return $this->errors;
        }
        $token = AppTokenCollection::generate_token();
        $token_model = AppTokenCollection::query()
                ->where(['app_id' => $this->app_id])
                ->first();
        if ($token_model) {
            $token_model->app_id = $this->app_id;
            $token_model->access_token = $token;
            $token_model->save();
        } else {
            $token_model = new AppTokenCollection;
            $token_model->app_id = $this->app_id;
            $token_model->access_token = $token;
            $token_model->save();
        }
        return [
            'access_token' => $token
        ];
    }

}

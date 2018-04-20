<?php

namespace App\Modules\PhaserGame\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Config;
use App\Modules\Api_token\Models\AppTokenCollection;
use App\Modules\Users\Models\UserManage;
use App\Modules\PhaserGame\Models\Game;
use App\Modules\PhaserGame\Models\GameEpisode;
use App\Modules\PhaserGame\Models\PhaserApiLogin;
use App\CustomLibrary\MyCrypt;
use App\Modules\PhaserGame\Models\StudentProgress;
use App\Modules\Users\Models\UserToken;

class FindALetterGameApiController extends Controller {

    private $response = array();

    public function __construct(Request $request) {
        $this->response['status'] = false;
        $this->response['errors'] = array();
        $this->response['datas'] = array();
        $this->response['message'] = '';
        
        $this->access_token = 'nF6thkn1RROXOTg6HZWcZr94091uiZEBo7no5TvIpcAxmhdnfVGLO29cQafszXNG';
        $header_info = $request->headers->all();
        if (isset($header_info['authorization'])) {
            if (isset($header_info['authorization'][0])) {
                $access_token = trim(str_replace('Bearer', '', $header_info['authorization'][0]));
                
                if ($access_token == $this->access_token) {
                    $token = AppTokenCollection::generate_token();
                    // re-new access token if expired                    
                } else {
                    $this->response['errors'][] = 'Access Token Not Matched.';
                }
            } else {
                $this->response['errors'][] = 'Illegal Request.';
            }
        } else {
            $this->response['errors'][] = 'Illegal Request.';
        }
    }

    public function level_list(Request $request) {
        
        if ($request->isMethod('post') && !$this->validate($request, PhaserApiLogin::general_rules_after_login()) && empty($this->response['errors'])) {
            $posted_data = $request->all();

            $this->response['letter_datas'] = [];
            $this->response['drawing_game_level'] = [];
            $this->response['game_model'] = [];
            $this->response['user_token'] = null;

            if ($new_token = UserToken::validate_user_token($posted_data['user_token'])) {
                $datas = [];
                $episode_datas = GameEpisode::query()
                        ->select(['id', 'game_id', 'episode_name', 'level','episode_datas'])
                        ->where(array('game_id' => $posted_data['game_id']))
                        ->orderBy('level')
                        ->get();
                if ($episode_datas) {
                    $student_id = UserToken::get_user_by_token($new_token);
                    $student_progress = StudentProgress::get_student_progress($posted_data['game_id'], $student_id);
                    if ($student_progress) {
                        $this->response['student_progress'] = $student_progress;
                    }
                    $datas = $episode_datas->toArray();
                }
                $game_model = array();

                $game_model_data = Game::query()
                        ->select(['name', 'sounds'])
                        ->where(['id' => $posted_data['game_id']])
                        ->first();
                if ($game_model_data) {
                    $game_model = $game_model_data->toArray();
                }
                $this->response['episode_datas'] = $datas;
                $this->response['find_game_level'] = GameEpisode::get_letter_finding_game_levels();
                $this->response['game_model'] = $game_model;
                $this->response['user_token'] = $new_token;
                $this->response['status'] = true;
                $this->response['message'] = 'Alphabets are loaded successfully';
            }
        }
        return $this->response;
    }

    public function episode_data(Request $request) {
        if ($request->isMethod('post') && !$this->validate($request, PhaserApiLogin::general_rules_after_login()) && empty($this->response['errors'])) {
            $posted_data = $request->all();
            if (!isset($posted_data['letter'])) {
                $this->response['errors'][] = 'letter is missing';
            }
            $data = [];
            if (empty($this->response['errors'])) {
                if ($new_token = UserToken::validate_user_token($posted_data['user_token'])) {
                    $letter = $posted_data['letter'];
                    $episode_data = GameEpisode::query()
                            ->select(['id', 'game_id', 'episode_name', 'episode_datas'])
                            ->where(array('episode_name' => trim($letter)))
                            ->first();

                    if ($episode_data) {
                        $student_id = UserToken::get_user_by_token($new_token);
                        $student_progress = StudentProgress::get_student_progress($posted_data['game_id'], $student_id);
                        if ($student_progress) {
                            $this->response['student_progress'] = $student_progress;
                        }
                        $data = $episode_data->toArray();
                        $data['episode_datas'] = json_decode($data['episode_datas']);
                    } else {
                        $data['episode_datas'] = [];
                    }
                    $this->response['data'] = $data;
                    $this->response['user_token'] = $new_token;
                    $this->response['status'] = true;
                    $this->response['message'] = 'Alphabets are loaded successfully';
                }
            }
        }

        return $this->response;
    }

    

}

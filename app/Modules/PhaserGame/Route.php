<?php

Route::group(['prefix' => Config::get('constants.admin_prefix'), 'middleware' => 'admin', 'namespace' => 'PhaserGame\Controllers'], function () {

    Route::get('/phaser-game', 'AdminController@index');
    Route::get('/phaser-game/create', 'AdminController@create');
    Route::post('/phaser-game/create', 'AdminController@create');
    Route::get('/phaser-game/update/{id}', 'AdminController@update');
    Route::post('/phaser-game/update/{id}', 'AdminController@update');
    Route::post('/phaser-game/delete/{id}', 'AdminController@delete');

    //game maintenance routes
    Route::get('/phaser-game/drawing-game-maintain', 'AdminDrowingGameController@episode_list');
    Route::get('/phaser-game/alpha-game-load-canvas/{game_id}/{id}', 'AdminDrowingGameController@load_canvas');

    Route::get('/phaser-game/drawing-game/create', 'AdminDrowingGameController@create_episode');
    Route::post('/phaser-game/drawing-game/create', 'AdminDrowingGameController@create_episode');

    Route::get('/phaser-game/drawing-game/update/{id}', 'AdminDrowingGameController@update_episode');
    Route::post('/phaser-game/drawing-game/update/{id}', 'AdminDrowingGameController@update_episode');

    Route::post('/phaser-game/drawing-game/delete/{id}', 'AdminDrowingGameController@delete_episode');

    Route::get('/phaser-game/drawing-game/episode-details/{id}', 'AdminDrowingGameController@detail_episode');
    Route::post('/phaser-game/drawing-game/save-episode-configuration/{id}', 'AdminDrowingGameController@save_episode_config');

    Route::get('/phaser-game/drawing-level-maintain', 'AdminDrowingGameController@level_list');
    Route::post('/phaser-game/drawing-level-maintain', 'AdminDrowingGameController@level_list');


    Route::get('/phaser-game/letter-finding-level-maintain', 'AdminLetterFindGameController@level_list');
    Route::post('/phaser-game/letter-finding-level-maintain', 'AdminLetterFindGameController@level_list');

    Route::get('/phaser-game/letter-finding-option-maintain', 'AdminLetterFindGameController@episode_list');

    Route::get('/phaser-game/letter-finding-game/create', 'AdminLetterFindGameController@create_episode');
    Route::post('/phaser-game/letter-finding-game/create', 'AdminLetterFindGameController@create_episode');

    Route::get('/phaser-game/letter-finding-game/update/{id}', 'AdminLetterFindGameController@update_episode');
    Route::post('/phaser-game/letter-finding-game/update/{id}', 'AdminLetterFindGameController@update_episode');
});

Route::group(['prefix' => '/', 'namespace' => 'PhaserGame\Controllers', 'middleware' => 'guest'], function() {
    Route::get('/game-list', 'UserController@index');
    Route::get('/alphabet-drowing-game', 'DrowingGameController@index');
    Route::get('/alphabet-drowing-game/detail/{id}', 'UserController@detail');
    Route::get('/alphabet-drowing-game/download/{id}', 'UserController@download');
    Route::get('/alphabet-drowing-game/canvas-path', 'UserDrowingGameController@user_canvas');

    //for user api

    Route::post('/phaser-game/student-list', 'UserDrowingGameApiController@get_student_list');
    Route::post('/phaser-game/login-request', 'UserDrowingGameApiController@login_request');
    Route::post('/phaser-game/alphabet-list', 'UserDrowingGameApiController@alphabet_list');
    Route::post('/phaser-game/alphabet-data', 'UserDrowingGameApiController@alphabet_data');

    Route::post('/phaser-game/find-a-letter-level-list', 'FindALetterGameApiController@level_list');
    Route::post('/phaser-game/find-a-letter-episode-data', 'FindALetterGameApiController@episode_data');

    Route::post('/phaser-game/record-progress', 'UserDrowingGameApiController@save_game_progress');
    Route::post('/phaser-game/test', 'UserDrowingGameApiController@test');

    ////////////
    Route::get('/alphabet-drowing-game/student-list-canvas', 'UserDrowingGameController@student_list_canvas');
    
    Route::get('/phaser-game/student-list', function() {
        $this->response = array();
        $student_list = DB::table('sys_users')
                ->select([
                    'sys_users.id',
                    'name',
                    'profile_pic',
                ])
                ->get()
                ->toArray();

        $this->response['image_size'] = \App\Modules\Users\Models\UserManage::PROFILE_ICON_SIZE_MINI;
        $this->response['status'] = true;
        $this->response['datas'] = $student_list;
        return $this->response;
        
        return view('PhaserGame::User.student_list');
        
    });
    Route::get('/phaser-game/login-request/{game_id}/{student_id}/{profile_pic}', function(Request $request, $game_id, $student_id, $profile_pic) {
        $this->response = array();
        $datas = DB::table('sys_users')
                ->leftjoin('sys_user_token', 'sys_user_token.user_id', '=', 'sys_users.id')
                ->select([
                    'sys_users.id',
                    'name',
                    'group_id',
                    'profile_pic',
                    'user_token'
                ])
                ->where(['sys_users.id' => $student_id, 'profile_pic' => $profile_pic])
                ->first();
        if ($datas) {
            if ($new_token = \App\Modules\Users\Models\UserToken::renew_token_with_id($student_id)) {
                $this->response['datas'] = $datas;
                $student_progress = App\Modules\PhaserGame\Models\StudentProgress::get_student_progress($game_id, $student_id);
                $this->response['student_progress'] = $student_progress;

                $this->response['user_token'] = $new_token;
                $this->response['status'] = true;
            }
        }
        return $this->response;
    });
    Route::get('/phaser-game/find-a-letter-level-list/{game_id}/{student_id}', function(Request $request, $game_id, $student_id) {
        $this->response = array();

        $datas = [];
        $episode_datas = \App\Modules\PhaserGame\Models\GameEpisode::query()
                ->select(['id', 'game_id', 'episode_name', 'level', 'episode_datas'])
                ->where(array('game_id' => $game_id))
                ->orderBy('level')
                ->get();
        if ($episode_datas) {
            $student_progress = App\Modules\PhaserGame\Models\StudentProgress::get_student_progress($game_id, $student_id);
            if ($student_progress) {
                $this->response['student_progress'] = $student_progress;
            }
            $datas = $episode_datas->toArray();
        }
        $game_model = array();

        $game_model_data = \App\Modules\PhaserGame\Models\Game::query()
                ->select(['name', 'sounds'])
                ->where(['id' => $game_id])
                ->first();
        if ($game_model_data) {
            $game_model = $game_model_data->toArray();
        }
        $this->response['episode_datas'] = $datas;
        $this->response['find_game_level'] = \App\Modules\PhaserGame\Models\GameEpisode::get_letter_finding_game_levels();
        $this->response['game_model'] = $game_model;
        $this->response['status'] = true;
        $this->response['message'] = 'Alphabets are loaded successfully';
        return $this->response;
    });

    Route::get('/phaser-game/record-progress/{game_id}/{student_id}/{level}/{episode}', function(Request $request, $game_id, $student_id,$level,$episode) {
        $this->response = array();

            $student_progress_model = App\Modules\PhaserGame\Models\StudentProgress::query()
                    ->where([
                        'student_id' => $student_id,
                        'game_id' => $game_id,
                        'level_id' => $level,
                        'episode_id' => $episode,
                    ])
                    ->first();

            if (!$student_progress_model) {
                $student_progress_model = new \App\Modules\PhaserGame\Models\StudentProgress();
            }
            if (isset($posted_data['answer'])) {
                $sbmitted_answer = json_encode($posted_data['answer']);
            } else {
                $sbmitted_answer = json_encode(array());
            }

            $student_progress_model->student_id = $student_id;
            $student_progress_model->game_id = $game_id;
            $student_progress_model->episode_id = $episode;
            $student_progress_model->level_id = $level;
            $student_progress_model->submitted_answers = $sbmitted_answer;
            $student_progress_model->save();
            $this->response['message'] = 'Saved successfully.';
        return $this->response;
    });
    Route::get('/phaser-game/test', 'UserDrowingGameApiController@test');
});

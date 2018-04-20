<?php

namespace App\Modules\PhaserGame\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\PhaserGame\Models\GameEpisode;
use Illuminate\Support\Facades\DB;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StudentProgress extends Model {

    protected $table = 'phaser_student_progress';

    public static function get_student_progress($game_id, $student_id) {
        $max_data = self::query()
                ->select(DB::raw('count(*) as total_episode,level_id,max(episode_id) as episode_id,game_id'))
                ->where(['game_id' => $game_id, 'student_id' => $student_id])
                ->orderBy('level_id','desc')
                ->orderBy('episode_id','desc')
                ->groupBy('level_id')
                ->first();
        
        $levels = GameEpisode::query()
                        ->select(DB::raw('count(*) as total_episode,level'))
                        ->where(['game_id' => $game_id])
                        ->groupBy('level')
                        ->get();
        
        if ($max_data && $levels) {
//            $max_data = $max_data->toArray();
//            $levels = $levels->toArray();
//            echo '<pre>';
//            print_r($max_data);
//            echo '<pre>';
//            print_r($levels);
//            exit;
        
            $passed_level = 0;
            foreach ($levels as $level){
                if($max_data->level_id == $level->level && $max_data->total_episode >= $level->total_episode ){
                    $passed_level = $level->level;
                }
            }
            
            return [
                'game_id' => $max_data->game_id,
                'level_id' => $passed_level,
                'episode_id' => $max_data->episode_id
            ];
        } else {
            return [
                'game_id' => $game_id,
                'level_id' => 0,
                'episode_id' => 0
            ];
        }
    }

}

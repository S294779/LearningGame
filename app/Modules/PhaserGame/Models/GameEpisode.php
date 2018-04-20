<?php

namespace App\Modules\PhaserGame\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GameEpisode extends Model {

    const GAME_DISPLAY_yes = 'Yes';
    const GAME_DISPLAY_no = 'No';


    const BACKGROUND_IMG_DIR = 'FrontSite/PhaserGames/game_files/game[%s]/episode[%s]/background_image'; // %s --> game id,%s --> episode id

    const BACKGROUND_IMG_DIR_temp = 'FrontSite/PhaserGames/game_files/game[%s]/temp_images/%s'; // %s --> game id,%s --> episode id

    const BACKGROUND_IMG_ICON_SIZE = '200X200';
    const BACKGROUND_IMG_DISPLAY_SIZE = '1000X800';

    const COMMAND_SOUND_DIR = 'FrontSite/PhaserGames/game_files/game[%s]/episode[%s]/command_sound';

    protected $table = 'phaser_game_episode';
    protected $filliable = [
        'game_id',
        'episode_name',
        'episode_image',
        'episode_datas',
        'episode_desc',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
    public $rules = [
        'episode_name' => 'required',
        'background_image' => 'required',
        'episode_desc' => 'required'
    ];
    public $rules_update = [
        'episode_name' => 'required',
        'episode_desc' => 'required'
    ];

    

    public $letter_finding_rules = [
        'episode_name' => 'required',
        'choice_options' => 'required|custom_rule:App\Modules\PhaserGame\Models\GameEpisode::contains_all_correct_options',
        //'background_image' => 'required',
        'command_sound' => 'required',
        'episode_desc' => 'required'
    ];
    public $letter_finding_rule_messages  = [
            'choice_options.custom_rule' => 'Choice field must contain all correct answers.',
        ];
    
    public $letter_finding_rules_update = [
        'episode_name' => 'required',
        'choice_options' => 'required|custom_rule:App\Modules\PhaserGame\Models\GameEpisode::contains_all_correct_options',
        'episode_desc' => 'required'
    ];

    public static function contains_all_correct_options($response) {
        
        $correct_answers = array_filter($response['correct_answers']);
        $choice_options = array_filter($response['choice_options']);
        $intersect = array_intersect($choice_options,$correct_answers);
//        echo '<pre>';
//        print_r($intersect);
//        exit;
        if ($correct_answers == $intersect) {
            return true;
        } else {
            return false;
        }
    }

    public function get_display_status() {
        return[
            self::GAME_DISPLAY_yes,
            self::GAME_DISPLAY_no
        ];
    }

    public function get_version_notify_conditions() {
        return[
            self::GAME_NOTIFY_NEW_VERSION_yes,
            self::GAME_NOTIFY_NEW_VERSION_no
        ];
    }

    public function get_image_sizes() {
        return [
            self::BACKGROUND_IMG_DISPLAY_SIZE,
            self::BACKGROUND_IMG_ICON_SIZE,
        ];
    }

    public static function get_drawing_game_levels() {
        return [
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
        ];
    }

    public static function get_letter_finding_game_levels() {
        return [
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
            5 => 'Level 5',
            6 => 'Level 6',
        ];
    }

    public function choice_list() {
        return [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e',
            'f' => 'f',
            'g' => 'g',
            'h' => 'h',
            'i' => 'i',
            'j' => 'j',
            'k' => 'k',
            'l' => 'l',
            'm' => 'm',
            'n' => 'n',
            'o' => 'o',
            'p' => 'p',
            'q' => 'q',
            'r' => 'r',
            's' => 's',
            't' => 't',
            'u' => 'u',
            'v' => 'v',
            'w' => 'w',
            'x' => 'x',
            'y' => 'y',
            'z' => 'z',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
            'G' => 'G',
            'H' => 'H',
            'I' => 'I',
            'J' => 'J',
            'K' => 'K',
            'L' => 'L',
            'M' => 'M',
            'N' => 'N',
            'O' => 'O',
            'P' => 'P',
            'Q' => 'Q',
            'R' => 'R',
            'S' => 'S',
            'T' => 'T',
            'U' => 'U',
            'V' => 'V',
            'W' => 'W',
            'X' => 'X',
            'Y' => 'Y',
            'Z' => 'Z',
        ];
    }

}

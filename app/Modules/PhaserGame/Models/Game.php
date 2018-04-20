<?php

namespace App\Modules\PhaserGame\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Game extends Model {

    const GAME_DISPLAY_yes = 'Yes';
    const GAME_DISPLAY_no = 'No';
    const GAME_NOTIFY_NEW_VERSION_yes = 'Yes';
    const GAME_NOTIFY_NEW_VERSION_no = 'No';

    const BACKGROUND_IMG_DIR = 'FrontSite/PhaserGames/game_files/game[%s]/background_image'; // %s --> game id
    const BACKGROUND_IMG_ICON_SIZE = '200X200';
    const BACKGROUND_IMG_DISPLAY_SIZE = '1000X800';


    const GAME_SOUND_DIR = 'FrontSite/PhaserGames/game_files/game[%s]/game_sounds'; // %s --> game id

    protected $table = 'phaser_games';
    protected $filliable = [
        'name',
        'game_image',
        'game_des',
        'notify_new_version',
        'download_num',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
    public $rules = [
        'name' => 'required',
        'game_desc' => 'required',
        'is_display' => 'required',
        'notify_new_version' => 'required',
        'game_image' => 'required',
        'game_default_sound' => 'required',
        'pick_star_sound' => 'required',
        'episode_main_url' => 'required_if:episode_main_url,',
    ];

    public function rule_msg() {
        return[
            'episode_main_url.required_if' => 'Episode Maintenance Url is required if not set.',
            'pick_star_sound.required' => 'Pick Sound(star) is required.',
        ];
    }

    public function rules_update() {
        return [
            'name' => 'required',
            'game_desc' => 'required',
            'is_display' => 'required',
            'notify_new_version' => 'required',
            'episode_main_url' => 'required_if:episode_main_url,',
            //'episode_main_url' => 'custom_rule:App\Modules\PhaserGame\Models\Game::test',
        ];
    }

    public static function test($response) {
        
        return true;
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

}

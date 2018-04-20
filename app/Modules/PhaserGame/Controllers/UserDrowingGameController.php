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
use App\Modules\PhaserGame\Models\Game;
use App\CustomLibrary\ImageUploader;
use App\Modules\PhaserGame\Models\GameEpisode;


class UserDrowingGameController extends Controller{
    
    public function user_canvas(){
        $game_model = Game::query()->where(['id' => 1])->first();
        return view('PhaserGame::UserDrawingGame.canvas', [
            'game_model' => $game_model,
        ]);
    }
    public function student_list_canvas(){
        $game_model = Game::query()->where(['id' => 1])->first();
        return view('PhaserGame::UserDrawingGame.student_list_canvas', [
            'game_model' => $game_model,
        ]);
    }
    
    
}
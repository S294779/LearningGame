<?php

namespace App\Http\Controllers\FrontSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Response;
use App\Modules\Webmgnt\Models\Banner;
use App\Modules\Webmgnt\Models\About;
use App\Modules\Webmgnt\Models\Project;

use App\CustomLibrary\Paypal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('welcome');
    }
    public function welcome($locale = 'en')
    {
        
        return view('FrontSite.home.welcome',[
        ]);
    }    

    public function index()
    {
        
        return view('FrontSite.home.home');
    }
    public function about(){
        $model = About::query()->where(['status'=>1])->first();
        return view('FrontSite.home.about',[
            'model'=>$model
        ]);
    }
    public function contact(){
        return view('FrontSite.home.contact');
    }
    public function subscription(){
        return redirect()->back();
    }
    
    public function setLanguage(Request $request, $locale) {
        $posted_data = $request->all();
        $prev_path = $posted_data['prevPath'];
        $params = $posted_data['params'];
        $prev_path_new = str_replace(['{locale?}','{locale}'],[$locale,$locale],$prev_path);
        return redirect($prev_path_new.$params);
    }
    /**
     * 
     * @param type $image_name
     * @return type
     */
    public function ImageDisplay($image_name)
    {
        $imageLocation = explode('.', $image_name);
        $onlyNameArr = array_reverse($imageLocation);
        $file_name = $onlyNameArr[1].'.'.$onlyNameArr[0];
        $only_location = str_replace($file_name,'', $image_name);
        $location = str_replace('.', '/', $only_location);
        
        $filename = storage_path('app/'.$location.'/'.$file_name);
        return Response::make( file_get_contents($filename));
    }
}

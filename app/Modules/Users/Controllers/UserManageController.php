<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Modules\Users\Models\UserManage;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Illuminate\Support\Facades\File;
use App\CustomLibrary\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Config;
use App\CustomLibrary\ImageUploader;
use App\Modules\Users\Models\UserToken;
use App\Modules\Api_token\Models\AppTokenCollection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserManageController extends Controller {

    public function index() {

        $model = new UserManage;
        return view('Users::userManage.index', [
        ]);
    }

    public function allusers(Request $request) {

        $db = new DB;
        return view('Users::userManage.index', [
            'db' => $db,
        ]);
    }

    public function newuser(Request $request) {

        $model = new UserManage;
        if ($request->isMethod('post') && !$this->validate($request, $model->user_manage_rules)) {
            $posted_data = $request->all();
            $model->name = $posted_data['name'];
            
            if(isset($posted_data['email'])){
                $model->email = $posted_data['email'];
            }            
            $model->status = $posted_data['status'];
            $model->password = bcrypt($posted_data['password']);
            $pro_image = '';
            if (isset($posted_data['profilepic'])) {
                $imageObj = $posted_data['profilepic'];
                $pro_image = ImageUploader::upload($imageObj, UserManage::FILE_DIR, UserManage::getImageSizes(), true);
            }
            $model->profile_pic = $pro_image;
            $model->save();
            

            $user_token_model = new UserToken;
            $user_token_model->id = $model->id;
            $user_token_model->user_token = AppTokenCollection::generate_token();
            $user_token_model->save();

            $request->session()->flash('success', 'User has been created successfylly.');
            return redirect('/admin/user-manage/updateuser/' . $model->id);
        }

        return view('Users::userManage.UserManageForm', [
            'model' => $model,
        ]);
    }

    public function updateuser(Request $request, $id) {

        $model = UserManage::query()->where(['id' => $id])->first();

        if ($request->isMethod('post') && !$this->validate($request, $model->user_manage_rules_update)) {

            $posted_data = $request->all();
            $model->name = $posted_data['name'];
            
            if(isset($posted_data['email'])){
                $model->email = $posted_data['email'];
            } 
            $model->status = $posted_data['status'];
            $pro_image = $model->profile_pic;
            if (isset($posted_data['profilepic'])) {
                $imageObj = $posted_data['profilepic'];
                ImageUploader::delete($pro_image, UserManage::FILE_DIR, UserManage::getImageSizes());
                $pro_image = ImageUploader::upload($imageObj, UserManage::FILE_DIR, UserManage::getImageSizes(), true);
            }
            $model->id = $model->id;
            $model->profile_pic = $pro_image;
            $model->save();

            $model->save();

            $request->session()->flash('success', 'User has been updated successfylly.');
            return redirect('/admin/user-manage/updateuser/' . $model->id);
        }

        return view('Users::userManage.UserManageForm', [
            'model' => $model
        ]);
    }

    public function deleteuser(Request $request, $id) {

        $model = UserManage::query()->where(['id' => $id])->first();
        ImageUploader::delete($model->profile_pic, UserManage::FILE_DIR, UserManage::getImageSizes());
        $profile_model = UserManage::query()->where(['id' => $id])->first();
        $profile_model->delete();
        $user_token_model = UserToken::query()->where(['id' => $id])->first();
        if ($user_token_model) {
            $user_token_model->delete();
        }
        if ($model) {
            $model->delete();
            $request->session()->flash('success', 'Deleted successfylly.');
        }

        return redirect(Config::get('constants.admin_prefix') . '/user-manage/allusers');
    }

    public function changepassword(Request $request) {

        $postedData = $request->all();
        if (isset($postedData['current_password'])) {
            if (!Hash::check($postedData['current_password'], Auth::guard('admin')->user()->username)) {
                $errorMessages = [];
                $errorMessages['current_password'] = 'Old Password Does not match.';

                if ($postedData['new_password'] == '') {
                    $errorMessages['new_password'] = 'New Password can not be empty.';
                }

                if ($postedData['new_password_confirmation'] == '') {
                    $errorMessages['new_password_confirmation'] = 'New Conform Password can not be empty.';
                }
                return redirect('/admin/user-manage/changepass')->withInput()->withErrors($errorMessages);
            }
            if ($request->isMethod('post') && !$this->validate($request, $this->validRule())) {
                $model = Auth::guard('admin')->user();
                $postedData = $request->all();
                $model->password = bcrypt($postedData['new_password']);

                $model->save();
                $request->session()->flash('success', 'Password has been changed successfully.');
                return redirect('/admin/user-manage/changepass');
            } else {
                
            }
        }
        return view('Users::userManage.changepassword', [
        ]);
    }

}

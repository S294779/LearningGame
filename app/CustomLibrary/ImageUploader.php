<?php

namespace App\CustomLibrary;

use App\CustomLibrary\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageUploader extends Image {

    public static function upload($imageObj, $des_dir, $image_sizes, $public_dir = true) {
        
        $file_name = time() . '.' . $imageObj->getClientOriginalExtension();
        if ($public_dir) {
            @mkdir(public_path("$des_dir/original"), 0777,true);
            $imageObj->move(public_path("$des_dir/original"),$file_name);
            
            $source_path = public_path("$des_dir/original/$file_name");
            
        } else {
            $imageObj->storeAs($des_dir . '/original', $file_name, []);
            $source_path = base_path("storage/app/$des_dir/original/") . $file_name;
        }
        foreach ($image_sizes as $size) {
            if ($public_dir) {
                $resize_path = public_path($des_dir . '/' . $size);
                @mkdir("$resize_path", 0777,true);
                $destination_path = $resize_path . '/' . $file_name;
                self::crop($size, $source_path, $destination_path);
            } else {
                $resize_path = $des_dir . '/' . $size;
                Storage::makeDirectory("$resize_path", 0777);
                $destination_path = base_path("storage/app/$resize_path/") . $file_name;
                self::crop($size, $source_path, $destination_path);
            }
        }
        return $file_name;
    }

    public static function move($src_dir, $des_dir, $image_sizes, $public_dir = true) {
       
        //deleting original file
        if($public_dir) {
            
            $imges = [];

            $source_path = public_path("$src_dir/original/");
            $destination_path = public_path("$des_dir/original/");
            $file_names = scandir($source_path);

            foreach($file_names as $file_name){
                if($file_name == '.' || $file_name == '..'){
                    continue;
                }
                $imges[] = $file_name;
                @mkdir($destination_path,0777,true);
                File::move($source_path.$file_name,$destination_path. $file_name);
            }

            foreach ($image_sizes as $size) {
                $source_path = public_path("$src_dir/$size/");
                $destination_path = public_path("$des_dir/$size/");
                $file_names = scandir($source_path);
                    foreach($file_names as $file_name){
                        if($file_name == '.' || $file_name == '..'){
                        continue;
                    }
                    $imges[] = $file_name;
                    @mkdir(public_path("$des_dir/$size/"),0777,true);
                    File::move($source_path.$file_name,$destination_path.$file_name);
                }
            }
            return $imges;
        } else {
            File::move(base_path("storage/app/$des_dir/original/" . $image_name));
            foreach ($image_sizes as $size) {
                $resize_path = $des_dir . '/' . $size;
                //deleting sized file
                File::move(base_path("storage/app/$resize_path/" . $image_name));
            }
        }
    }
    public static function delete($image_name, $des_dir, $image_sizes, $public_dir = true) {
        //deleting original file
        if($public_dir) {
            
            File::Delete(public_path("$des_dir/original/" . $image_name));
            @rmdir(public_path("$des_dir/original"));
            foreach ($image_sizes as $size) {
                $resize_path = $des_dir . '/' . $size;
                //deleting sized file
                File::delete(public_path("$resize_path/" . $image_name));
                @rmdir(public_path("$resize_path"));
            }
        } else {
            File::Delete(base_path("storage/app/$des_dir/original/" . $image_name));
            @rmdir(base_path("storage/app/$des_dir/original"));
            foreach ($image_sizes as $size) {
                $resize_path = $des_dir . '/' . $size;
                //deleting sized file
                File::delete(base_path("storage/app/$resize_path/" . $image_name));
                @rmdir(base_path("storage/app/$resize_path"));
            }
        }
    }

}

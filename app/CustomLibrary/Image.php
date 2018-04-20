<?php
namespace App\CustomLibrary;
use Exception;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Image{
    
    public static function resizer($image_size,$image_source_path,$image_destination_path){
        $image_size = strtolower($image_size);
        if (!$result = preg_match('/^([0-9]+)x([0-9]+)$/',$image_size))
        {
            throw new Exception('Invalid size is in first parameter.Example "100x100".');
        }
        list($required_width,$required_height) = explode('x', $image_size);
        
        //retriving images from original image
        list($original_width, $original_height) = getimagesize($image_source_path);
        
        $ratio = $original_width / $original_height;
        
        if ($ratio > 1) {
            $required_height = (int)($required_height / $ratio);
        } else {
            $required_width = (int)($required_width * $ratio);
        }
        
        $file_info = pathinfo($image_source_path);
        if($file_info['extension'] == 'jpg'){
            $src_row_file = imagecreatefromjpeg($image_source_path);
        }elseif($file_info['extension'] == 'png'){
            $src_row_file = imagecreatefrompng($image_source_path);
        }elseif($file_info['extension'] == 'gif'){
            $src_row_file = imagecreatefromgif($image_source_path);
        }elseif($file_info['extension'] == 'bmp'){
            $src_row_file = imagecreatefromwbmp($image_source_path);
        }else{
            throw new Exception('Unsupported file extension.');
        }
        if($file_info['extension'] == 'png'){
            $dst_row_file = imagecreate($required_width, $required_height);
        }else{
            $dst_row_file = imagecreatetruecolor($required_width, $required_height);
        }
        
        
        imagecopyresized($dst_row_file,$src_row_file, 0, 0, 0, 0, $required_width, $required_height, $original_width, $original_height);
        
        if($file_info['extension'] == 'jpg'){
           imagejpeg($dst_row_file,$image_destination_path); 
        }
        if($file_info['extension'] == 'png'){
            imagepng($dst_row_file,$image_destination_path); 
        }
        if($file_info['extension'] == 'gif'){
            imagegif($dst_row_file,$image_destination_path); 
        }
        if($file_info['extension'] == 'bmp'){
            image2wbmp($dst_row_file,$image_destination_path); 
        }
        imagedestroy($dst_row_file);
        
        return;
    }
    public static function crop($image_size,$image_source_path,$image_destination_path){
        $image_size = strtolower($image_size);
        
        if (!$result = preg_match('/^([0-9]+)x([0-9]+)$/',$image_size))
        {
            throw new Exception('Invalid size is in first parameter.Example "100x100".');
        }
        list($required_width,$required_height) = explode('x', $image_size);
        
        //retriving images from original image
        list($original_width, $original_height) = getimagesize($image_source_path);
        
        $x_ratio = $original_width/$required_width;//divided by zero exception
        $y_ratio = $original_height/$required_height;//divided by zero exception
        
        if($x_ratio < $y_ratio){
            $ratio = $x_ratio;
        }else{
            $ratio = $y_ratio;
        }
        
        $new_width = $ratio*$required_width;
        $new_height = $ratio*$required_height;
        
        $file_info = pathinfo($image_source_path);
        if($file_info['extension'] == 'jpg'){
            $src_row_file = imagecreatefromjpeg($image_source_path);
        }elseif($file_info['extension'] == 'png'){
            $src_row_file = imagecreatefrompng($image_source_path);
        }elseif($file_info['extension'] == 'gif'){
            $src_row_file = imagecreatefromgif($image_source_path);
        }elseif($file_info['extension'] == 'bmp'){
            $src_row_file = imagecreatefromwbmp($image_source_path);
        }else{
            throw new Exception('Unsupported file extension.');
        }
        $origin_x = (int)($original_width-$new_width)/2;
        $origin_y = (int)($original_height - $new_height)/2;
        
        $rect = [
            'x'=>$origin_x,
            'y'=>$origin_y,
            'width'=>$new_width,
            'height'=>$new_height
        ];
        
        $new_width = $ratio*$required_width;
        $new_height = $ratio*$required_height;
        
        $new_cropped = imagecrop($src_row_file, $rect);
        @unlink($image_destination_path);
        
        
        if($file_info['extension'] == 'jpg'){
           imagejpeg($new_cropped,$image_destination_path); 
        }
        if($file_info['extension'] == 'png'){
            imagepng($new_cropped,$image_destination_path); 
        }
        if($file_info['extension'] == 'gif'){
            imagegif($new_cropped,$image_destination_path); 
        }
        if($file_info['extension'] == 'bmp'){
            image2wbmp($new_cropped,$image_destination_path); 
        }
        imagedestroy($new_cropped);
        
        self::resizer($image_size,$image_destination_path,$image_destination_path);
        return;
    }
    
    
}
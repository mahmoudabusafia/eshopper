<?php

namespace App\Helpers;

class Image
{
    public static function addImage($request, $folder= ''){
        if($request->hasFile('image')) {

            $file = $request->file('image');

            $image_file = $file->store('/'.$folder , [
                'disk' => 'uploads',
            ]);
            $request->merge([
                'image_path' => $image_file,
            ]);
        }
    }
    public static function updateImage($request, $object , $folder= ''){
        if($request->hasFile('image')) {
            if($object->image_path !== null){
                unlink(public_path('uploads\\').$object->image_path);
            }

            $file = $request->file('image');

            $image_file = $file->store('/'.$folder , [
                'disk' => 'uploads',
            ]);
            $request->merge([
                'image_path' => $image_file,
            ]);
        }
    }
    public static function deleteImage($object , $folder= ''){
        if($object->image_path !== null){
            unlink(public_path('uploads\\').$object->image_path);
        }
    }
}

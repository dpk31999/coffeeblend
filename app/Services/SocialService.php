<?php

namespace App\Services;
use Validator,Redirect,Response,File;

class SocialService
{
    public static function create()
    {
        return new static();
    }

    public function handleUploadAvatar($getInfo)
    {
        if(isset($getInfo->avatar))
        {
            $fileContents = file_get_contents($getInfo->avatar);

            $image_path = 'thumb/' . time() . '.' . 'jpg';

            File::put(public_path() . '/storage/' . $image_path, $fileContents);

            return $image_path;
        }
        else{
            return $image_path = 'thumb/default_ava.jpg';
        }
    }
}

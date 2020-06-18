<?php

namespace App\Services;
use Illuminate\Support\Facades\File;

class PostService
{
    public static function create()
    {
        return new static();
    }

    public function handleUploadThumbPost($request)
    {   
        if(isset($request->url_image))
        {
            $image = $request->url_image;

            $image_path = 'thumbpost/' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/thumbpost');
            $image->move($path ,$image_path);
        }
        else{
            $image_path = 'uploads/default_product.png';
        }

        return $image_path;
    }

    public function handleDeleteThumbPost($post)
    {
        if(File::exists(public_path('storage/' . $post->url_thumb))){

            File::delete(public_path('storage/' . $post->url_thumb));
        }
    }
}

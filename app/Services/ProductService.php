<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ProductService
{
    public static function create()
    {
        return new static();
    }

    public function handleUploadImageProduct($request)
    {
        $image = $request->url_image;

        $image_path = 'uploads/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/uploads');
        $image->move($path ,$image_path);

        return $image_path;
    }

    public function handleDeleteImageProduct($product)
    {
        if(File::exists(public_path('storage/' . $product->url_image))){

            File::delete(public_path('storage/' . $product->url_image));
        }
    }
}

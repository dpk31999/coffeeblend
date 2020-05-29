<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
use App\Profile;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user(); 
        $user = $this->createUser($getInfo,$provider); 
        auth()->login($user);
        return redirect('/');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            if(isset($getInfo->avatar))
            {
                $fileContents = file_get_contents($getInfo->avatar);

                $image_path = 'thumb/' . time() . '.' . 'jpg';

                File::put(public_path() . '/storage/' . $image_path, $fileContents);
            }
            else{
                $image_path = 'thumb/default_ava.jpg';
            }

            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'url_thumb' => $image_path,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => '0'
            ]);
        }
        return $user;
    }
}

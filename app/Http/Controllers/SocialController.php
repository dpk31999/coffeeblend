<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
use App\Profile;

use App\Services\SocialService;

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
        if($user->status == '1')
        {
            return redirect('/')->with([
                'errorFb' => 'Your account have been locked, please contact admin !!!',
                'key' => '1'
            ]);
        }
        auth()->login($user);
        return redirect('/');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $socialService = SocialService::create();
            $socialService->handleUploadAvatar($getInfo);

            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'url_thumb' => $socialService->handleUploadAvatar($getInfo),
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => '0'
            ]);
        }
        return $user;
    }
}

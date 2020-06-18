<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
        ]);

        if($validator->passes())
        {
            // $this->create($request->all());

            if(isset($request->image))
            {
                $image = $request->image;

                $image_path = 'thumb/' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/storage/thumb');
                $image->move($path ,$image_path);
            }
            else{
                $image_path = 'thumb/default_ava.jpg';
            }

            $id = DB::table('users')->max('id');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'url_thumb' => $image_path,
                'provider' => 'common',
                'provider_id' => $id +1,
                'status' => '0'
            ]);

            // $this->guard()->login($user);   
        }

        return response()->json(['error'=>$validator->errors()->all()]);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     // return Validator::make($data, [
    //     //     'name' => ['required', 'string', 'max:255'],
    //     //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //     //     'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
    //     // ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {   
    //     if(isset($data['image']))
    //     {
    //         $image = $data['image'];

    //         $image_path = 'thumb/' . time() . '.' . $image->getClientOriginalExtension();
    //         $path = public_path('/storage/thumb');
    //         $image->move($path ,$image_path);
    //     }
    //     else{
    //         $image_path = 'thumb/default_ava.jpg';
    //     }

    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'url_thumb' => $image_path
    //     ]);
    // }
}

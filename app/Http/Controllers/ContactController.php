<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {   
        $title = 'Contact';
        return view('client.contact',\compact('title'));
    }

    public function validator($request)
    {
        return $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);
    }

    public function store(Request $request)
    {   

        if ($this->validator($request)->passes()) {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
        }
        
        return response()->json(['error'=>$this->validator($request)->errors()->all()]);
    }
}

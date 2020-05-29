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

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);
        if ($validator->passes()) {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
        }
        
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}

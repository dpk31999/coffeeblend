<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{10}/',
            'message' => 'required|string'
        ]);

        if($validator->passes())
        {
            $dt = Carbon::now();
            $time = \strtotime($request->date);
            $timenow = strtotime($dt->toDateTimeString());

            if($time-$timenow < 0)
            {
                return \response()->json(['error_date' => 'Please enter the correct date']);
            }

            Booking::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'date' => $request->date,
                'time' => $request->time,
                'phone' => $request->phone,
                'message' => $request->message,
                'status' => '0'
            ]);
        }
        
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}

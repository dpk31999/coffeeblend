<?php

namespace App\Http\Controllers\Api\v1;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{   
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }

    public function index()
    {
        $books = Booking::all();

        return response()->json($books, 200);
    }

    public function validator($request)
    {
        return $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{10}/',
            'message' => 'required|string'
        ]);
    }

    public function validateTime($request)
    {
        $dt = Carbon::now();
        $time = \strtotime($request->date);
        $timenow = strtotime($dt->toDateTimeString());

        if($time < $timenow)
        {
            return false;
        }

        return true;
    }

    public function store(Request $request)
    {   
        if($this->validateTime($request) == false)
        {
            return \response()->json(['error_date' => 'Please enter the correct date']);
        }

        if($this->validator($request)->passes())
        {

            $booking = Booking::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'date' => $request->date,
                'time' => $request->time,
                'phone' => $request->phone,
                'message' => $request->message,
                'status' => '0'
            ]);

            return response()->json($booking, 200);
        }
        
        return response()->json(['error'=>$this->validator($request)->errors()->all()],405);
    }

    public function refuse($book_id)
    {   
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = Booking::findOrFail($book_id);
        $booking->status = 2;
        
        $booking->save();

        return response()->json([
            'status' => 'Success',
            'booking' => $booking
        ], 200);
    }

    public function confirm($book_id)
    {   
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = Booking::findOrFail($book_id);
        $booking->status = 1;
        
        $booking->save();

        return response()->json([
            'status' => 'Success',
            'booking' => $booking
        ], 200);
    }
}

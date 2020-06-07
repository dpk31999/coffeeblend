<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $books = Booking::all();

        return view('admin.booking',\compact('books'));
    }

    public function refuse($book_id)
    {   
        $booking = Booking::findOrFail($book_id);
        $booking->status = 2;
        
        $booking->save();

        return response()->json(
            ['status' => 'Refuse']
        , 200);
    }

    public function confirm($book_id)
    {   
        $booking = Booking::findOrFail($book_id);
        $booking->status = 1;
        
        $booking->save();

        return response()->json(
            ['status' => 'Confirm']
        , 200);
    }
}

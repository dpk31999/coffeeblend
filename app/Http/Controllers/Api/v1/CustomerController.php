<?php

namespace App\Http\Controllers\Api\v1;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }

    public function index()
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $customers = Customer::all();

        return response()->json($customers, 200);
    }

    public function show(Customer $customer)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Success',
            'customer' => $customer
        ], 200);
    }
}

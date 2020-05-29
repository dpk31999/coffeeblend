<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Events\CustomerOrder;

use App\Customer;
use App\Invoice;
use App\InvoiceProduct;
use App\Product;

class CheckOutController extends Controller
{
    public function index()
    {   
        $title = 'Check Out';
        return view('client.checkout',\compact('title'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'select' => 'required',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->passes()) {
            if($request->totalCart == 0)
            {
                return response()->json(['error_cart'=>'Your cart is empty']);
            }
            else{
                $customer = Customer::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'country' => $request->select,
                    'street_address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email
                ]);

                $invoice = Invoice::create([
                    'customer_id' => $customer->id,
                    'total_price' => $request->totalCart,
                    'status' => 'waiting'
                ]);

                $arrCart = json_decode($request->cartArray);
                for($i =0;$i<count($arrCart);$i++)
                {   
                    $product = Product::where('name',$arrCart[$i]->name)->first();
                    InvoiceProduct::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $product->id,
                        'quantity' => $arrCart[$i]->count
                    ]);
                }

                \event(new CustomerOrder($invoice));
            }
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}

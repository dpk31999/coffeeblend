<?php

namespace App\Http\Controllers\Api\v1;

use App\Invoice;
use App\Product;
use App\Customer;
use App\InvoiceProduct;
use Illuminate\Http\Request;
use App\Events\CustomerOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
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

        $invoices = Invoice::all();

        return response()->json($invoices, 200);
    }

    public function show(Invoice $invoice)
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
            'invoice' => $invoice
        ], 200);
    }

    public function complete(Invoice $invoice)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $invoice->status = 1;
        
        $invoice->save();

        return response()->json([
            'message' => 'Success',
            'invoice' => $invoice
        ], 200);
    }

    public function validator($request)
    {
        return $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'select' => 'required',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|string|email|max:255',
        ]);
    }
    public function storeCustomer($request)
    {
        $customer = Customer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'country' => $request->select,
            'street_address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return $customer;
    }

    public function storeInvoice($request,$customer)
    {
        $invoice = Invoice::create([
            'customer_id' => $customer->id,
            'total_price' => $request->totalCart,
            'status' => '0'
        ]);

        return $invoice;
    }

    public function storeOrder($request,$invoice)
    {
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
    }

    public function store(Request $request)
    {      

        if ($this->validator($request)->passes()) {

            if($request->totalCart == 0)
            {
                return response()->json(['error_cart'=>'Your cart is empty']);
            }
            else{
                $customer = $this->storeCustomer($request);

                $invoice = $this->storeInvoice($request,$customer);

                $order = $this->storeOrder($request,$invoice);

                // send mail to customer who is order
                \event(new CustomerOrder($invoice));
            }
        }

    	return response()->json(['error'=>$this->validator($request)->errors()->all()]);
    }
}

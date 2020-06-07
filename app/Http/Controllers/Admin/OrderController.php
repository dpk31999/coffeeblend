<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Invoice;

class OrderController extends Controller
{   
    public function index()
    {
        $invoices = Invoice::all();

        return view('admin.orders',\compact('invoices'));
    }

    public function completedOrder($invoice_id)
    {   
        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->status = 1;
        
        $invoice->save();

        return response()->json(
            ['status' => 'Completed']
        , 200);
    }

    public function getCustomer(Invoice $invoice)
    {
        $customer = $invoice->customer;

        $count_invoice = $customer->invoices->count();

        return response()->json([
            'customer' => $customer,
            'count' => $count_invoice
        ], 200);
    }

    public function getInvoice(Invoice $invoice)
    {
        $hasProducts = $invoice->hasProducts;
        $products = [];
        foreach($hasProducts as $hasProduct)
        {   
            $hasProduct->product->quantity = $hasProduct->quantity;
            array_push($products,$hasProduct->product);
        }
        $total = $invoice->total_price;

        return response()->json([
            'products' => $products,
            'total' => $total
        ], 200);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_id','total_price','status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function hasProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['firstname','lastname','country','street_address','phone','email'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

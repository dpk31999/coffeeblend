<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['cate_id','name','price','description','url_image'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id');
    }

    public function invoice()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}

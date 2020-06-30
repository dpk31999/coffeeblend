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

    public function scopeBestSeller()
    {
        return Product::withCount('invoice')->orderByDesc('invoice_count')->skip(0)->take(4)->get();
    }

    public function scopeCallCategory($query,$name)
    {   
        return $query->whereHas('category', function($query) use ($name) {
                $query->where('name', $name);
            })->get();
    }

    public function scopeSearchByName($query,$name)
    {
        return $query->where('name', 'like', '%' . $name . '%')->get();
    }
}

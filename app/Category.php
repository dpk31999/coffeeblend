<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['admin_id','name'];

    public function products()
    {
        return $this->hasMany(Product::class,'cate_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

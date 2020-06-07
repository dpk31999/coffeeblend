<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{   

    protected $guard = 'admin';
    
    protected $fillable = [
        'name', 'username', 'password','email'
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return null !== $this->role()->where('name', $role)->first();
    }

    public function hasRoles($roles)
    {
        return null !== $this->role()->whereIn('name', $roles)->first();
    }

    public function get_role()
    {
        return $this->role()->first();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
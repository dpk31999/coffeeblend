<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements JWTSubject
{   

    protected $guard = 'admin';
    
    protected $fillable = [
        'name', 'username', 'password','email'
    ];

    protected $hidden = [
        'password'
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
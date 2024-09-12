<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Attributes that should be hidden for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-many relationship with the Art model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arts()
    {
        return $this->hasMany(Art::class);
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isSupport()
    {
        return $this->role === 'support';
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

}

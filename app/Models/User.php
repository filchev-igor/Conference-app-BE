<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Ensure HasApiTokens is imported

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; // Ensure HasApiTokens is used here

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'conferences_ids',
        'backgroundClassName',
    ];

    protected $casts = [
        'conferences_ids' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

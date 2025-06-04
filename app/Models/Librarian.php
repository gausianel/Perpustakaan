<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Librarian extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'librarian_name',       // tambahkan jika pakai email untuk login
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}

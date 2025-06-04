<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Librarian extends Authenticatable
{
    use Notifiable;

        protected $guard = 'librarian';


    protected $fillable = [
        'librarian_name',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function borrowedrecaps()
    {
        return $this->hasMany(Giveback::class);
    }

    public function givebacks()
    {
        return $this->hasMany(Giveback::class);
    }

}

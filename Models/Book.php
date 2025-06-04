<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'genre_id',
        'title',
        'author',
        'publisher',
        'year',
       
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function borroweds()
    {
        return $this->hasMany(Borrowed::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'borrowed_date',
        'expected_return_date',
        'is_returned',
    ];

    protected $casts = [
        'borrowed_date' => 'date',
        'expected_return_date' => 'date',
        'is_returned' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function giveback()
    {
        return $this->hasOne(Giveback::class);
    }
}


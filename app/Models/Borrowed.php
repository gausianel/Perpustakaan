<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'borrowed_date',
        'expected_return_date',
        'is_returned',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giveback()
    {
        return $this->hasOne(Giveback::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveback extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowed_id',
        'librarian_id',
        'date_returned',
    ];

    protected $casts = [
        'date_returned' => 'date',
    ];

    public function borrowed()
    {
        return $this->belongsTo(Borrowed::class);
    }

    public function librarian()
    {
        return $this->belongsTo(Librarian::class);
    }
}
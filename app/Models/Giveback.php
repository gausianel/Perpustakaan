<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveback extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowed_id',
        'date_returned',
    ];

    public function borrowed()
    {
        return $this->belongsTo(Borrowed::class);
    }
}

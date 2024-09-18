<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'art_id',
        'quantity',
        'amount',
    ];

    // Define a relationship with the Art model
    public function art()
    {
        return $this->belongsTo(Art::class);
    }
}

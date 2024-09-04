<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    // Ensure this line is either removed or corrected if present
    protected $table = 'arts';

    // The attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'user_id', // Ensure user_id is included if you want to allow mass assignment
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

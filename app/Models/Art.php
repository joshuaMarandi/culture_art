<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    // Specify the table name if different from 'arts'
    // protected $table = 'arts';

    // The attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
    ];

    // If there's a relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If there's a relationship with a Category model (optional)
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}

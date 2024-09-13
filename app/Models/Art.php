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
        'category_id',
        'user_id', // Ensure user_id is included if you want to allow mass assignment
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class); // Adjust the class name if your review model is named differently
    }

    /**
     * Get the category that owns the art.
     */
    public function category()
{
    return $this->belongsTo(Category::class);
}

}

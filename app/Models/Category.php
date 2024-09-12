<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function arts()
    {
        return $this->hasMany(Art::class);
    }
}


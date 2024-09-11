<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReviewsTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'art_id' => 1,
                'user_id' => 1,
                'comment' => 'Great artwork! Really enjoyed the details and colors.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'art_id' => 1,
                'user_id' => 2,
                'comment' => 'Nice piece, but the frame could be better.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'art_id' => 2,
                'user_id' => 1,
                'comment' => 'Not quite what I expected. The quality is average.',
                'rating' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'art_id' => 2,
                'user_id' => 3,
                'comment' => 'Fantastic work! The artist did a brilliant job.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'art_id' => 3,
                'user_id' => 4,
                'comment' => 'The art is good, but the delivery was late.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

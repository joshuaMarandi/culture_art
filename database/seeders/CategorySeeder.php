<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     //
    // }
    // database/seeders/CategorySeeder.php

public function run()
{
    $categories = [
        'Painting',
        'Drawing',
        'Sculpture',
        'Photography',
        'Printmaking',
        'Theater',
        'Dance',
        'Music',
        'Opera',
        'Crafts',
        'Textiles',
        'Jewelry',
        'Digital Painting',
        'Animation',
        'Interactive Art',
        'Poetry',
        'Prose',
        'Playwriting',
        'Historical Artifacts',
        'Traditional Art Forms',
        'Folk Art',
        'Historical Architecture',
        'Modern Architecture',
        'Mixed Media',
        'Street Art',
        'Installation Art'
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create(['name' => $category]);
    }
}

}

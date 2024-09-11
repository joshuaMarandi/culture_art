<?php

// database/migrations/xxxx_xx_xx_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('art_id')->constrained('arts')->onDelete('cascade'); // Foreign key to the arts table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to the users table
            $table->text('comment');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

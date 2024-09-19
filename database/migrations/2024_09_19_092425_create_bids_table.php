<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('art_id')->constrained('arts')->onDelete('cascade'); // Foreign key to 'arts' table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to 'users' table
            $table->decimal('amount', 10, 2); // Bid amount
            $table->timestamp('bid_time'); // Time the bid was made
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}

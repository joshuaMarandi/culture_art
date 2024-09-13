<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('arts', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id')->nullable(); // Add the category_id column
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('arts', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID of Discussion
            $table->string('title')->unique(); // Title of discussion
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->unsignedBigInteger('category_id'); // Foreign Key to categories
            $table->string('slug')->unique(); // Category Slug
            $table->boolean('pinned')->default(0); // Pinned has pinned posts at top of page
            $table->text('body'); // Body for the discussion post
            $table->string('image')->nullable(); // Any images that are added to the post
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}

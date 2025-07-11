<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('slug',191)->unique();
            $table->text('content');
            $table->string('short_description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('user-id');
            $table->foreign('id')->references('user_id')->on('users');
            // $table->string('author');
            // $table->string('category');
            // $table->string('tags')->nullable();
            // $table->boolean('is_published')->default(false);
            // $table->dateTime('published_at')->nullable();
            // $table->integer('views')->default(0);
            // $table->integer('likes')->default(0);
            // $table->integer('dislikes')->default(0);
            // $table->integer('comments_count')->default(0);
            // $table->string('meta_title')->nullable();
            // $table->string('meta_description')->nullable();
            // $table->string('meta_keywords')->nullable();
            // $table->string('meta_image')->nullable();   
            // $table->string('meta_robots')->default('index, follow');
            // $table->string('meta_canonical')->nullable();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}

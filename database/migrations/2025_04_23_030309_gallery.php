<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('gallery')){
            Schema::create('gallery', function (Blueprint $table) {
                $table->id();
                $table->foreign("id")->references("id")->on("users")->onDelete("cascade");
                $table->string('image_slug')->nullable();
                // $table->string('slug')->unique();
                $table->text('image_title');
                // $table->string('image')->nullable();
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

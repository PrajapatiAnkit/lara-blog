<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog_title','255');
            $table->string('category_id','255');
            $table->string('blog_description','255');
            $table->string('blog_images','255');
            $table->integer('added_by');
            $table->string('blog_slug','255');
            $table->integer('like_count');
            $table->integer('dislike_count');
            $table->integer('comment_count');
            $table->string('liked_by_users','255');
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
        Schema::dropIfExists('lara_blogs');
    }
}

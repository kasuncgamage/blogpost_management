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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->integer('blog_post_id', true);
            $table->unsignedBigInteger('author_id')->index('FK_user_blog_posts_author_id');
            $table->integer('post_type_id')->index('FK_post_types_blog_posts_type_id');
            $table->string('blog_post_title')->nullable();
            $table->longText('blog_post_content')->nullable();
            $table->string('blog_post_content_short')->nullable();
            $table->date('blog_post_publish_date')->nullable();
            $table->tinyText('blog_post_image_url')->nullable()->comment('json_encoded image urls');
            $table->dateTime('blog_post_created_at')->nullable()->useCurrent();
            $table->dateTime('blog_post_updated_at')->nullable();
            $table->dateTime('blog_post_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
};

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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->foreign(['post_type_id'], 'FK_post_types_blog_posts_type_id')->references(['post_type_id'])->on('post_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['author_id'], 'FK_user_blog_posts_author_id')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign('FK_post_types_blog_posts_type_id');
            $table->dropForeign('FK_user_blog_posts_author_id');
        });
    }
};

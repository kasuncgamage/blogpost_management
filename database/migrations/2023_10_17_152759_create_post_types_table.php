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
        Schema::create('post_types', function (Blueprint $table) {
            $table->integer('post_type_id')->primary();
            $table->string('post_type_desc')->nullable()->default('');
            $table->dateTime('post_type_created_at')->nullable()->useCurrent();
            $table->dateTime('post_type_updated_at')->nullable();
            $table->dateTime('post_type_deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_types');
    }
};

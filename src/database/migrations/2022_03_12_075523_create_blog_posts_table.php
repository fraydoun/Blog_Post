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
            $table->id();
            $table->bigInteger('blog_category_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug_title');
            $table->string('slug')->unique();
            $table->text('short_content');
            $table->longtext('content');
            $table->string('photo')->nullable();
            $table->string('tags');
            $table->bigInteger('admin_id')->unsigned();//related to admin table
            $table->integer('view_counter')->default(1);
            $table->timestamps();

            $table->foreign('blog_category_id')
                    ->references('id')
                    ->on('blog_categories')
                    ->onDelete('cascade');
            $table->foreign('admin_id')
                    ->references('id')
                    ->on('admin')->onDelete('cascade');

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

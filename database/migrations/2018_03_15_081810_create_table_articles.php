<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('articles', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('cover_picture');
        //     $table->string('title');
        //     $table->string('slug');
        //     $table->text('content');
        //     $table->integer('category_id');
        //     $table->string('author');
        //     $table->integer('publish');
        //     $table->softDeletesTz();
        //     $table->timestamps();
        // });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('articles');
    }
}
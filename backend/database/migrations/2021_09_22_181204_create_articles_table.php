<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 150);
            $table->tinyText('tags');
            $table->longText('unformatted_text');
            $table->longText('formatted_text');
            $table->string('images_path')->nullable();
            $table->string('images_absolute_path')->nullable();
            $table->string('images_names')->nullable();
            $table->tinyText('description');
            $table->integer('status'); //1- published | 2- rascunho | 3- deleted 
            $table->string('url')->unique(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

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
            $table->string("nom")->unique();
            $table->string("noSerie")->unique();
            $table->string("imageUrl")->nullable();
            $table->boolean("estDisponible")->default(1);
            $table->foreignId("type_article_id")->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("articles", function(Blueprint $table){
            $table->dropForeign("type_article_id");
        });
        Schema::dropIfExists('articles');
    }
}

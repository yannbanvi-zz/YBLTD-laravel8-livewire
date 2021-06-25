<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleProprieteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_propriete', function (Blueprint $table) {
            $table->foreignId("article_id")->constrained();
            $table->foreignId("propriete_article_id")->constrained();
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
        Schema::table('article_propriete', function (Blueprint $table) {
            $table->dropForeign("article_id");
            $table->dropForeign("propriete_article_id");
        });

        Schema::dropIfExists('article_propriete');
    }
}

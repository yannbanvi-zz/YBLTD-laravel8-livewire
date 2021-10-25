<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValeurFieldToTableArticleProprieteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_propriete', function (Blueprint $table) {
            $table->string("valeur");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_propriete', function (Blueprint $table) {
            $table->dropColumn("valeur");
        });
    }
}

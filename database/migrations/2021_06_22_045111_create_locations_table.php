<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->dateTime("dateDebut");
            $table->dateTime("dateFin");
            $table->foreignId("client_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("statut_location_id")->constrained();
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
        Schema::table('locations', function(Blueprint $table){
            $table->dropForeign(["client_id", "user_id", "statut_location_id"]);
        });

        Schema::dropIfExists('locations');
    }
}

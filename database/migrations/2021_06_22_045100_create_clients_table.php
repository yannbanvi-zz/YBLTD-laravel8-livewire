<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->date("dateNaissance");
            $table->string("lieuNaissance");
            $table->string("nationalite");
            $table->string("ville");
            $table->string("pays");
            $table->string("adresse");
            $table->string("telephone1");
            $table->string("email")->nullable();
            $table->string("telephone2")->nullable();
            $table->string("pieceIdentite");
            $table->string("noPieceIdentite");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

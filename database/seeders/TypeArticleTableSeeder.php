<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("type_articles")->insert([
            ["nom"=> "Voiture"],
            ["nom"=> "Immobilier"],
            ["nom"=> "Appareils Electroniques"],
            ["nom"=> "Salle"]
        ]);

        DB::table("propriete_articles")->insert([
            ["nom" => "Marque", "type_article_id" => 1],
            ["nom" => "Kilometrage", "type_article_id" => 1],
            ["nom" => "Prix", "type_article_id" => 2],
            ["nom" => "Libelle", "type_article_id" => 2],
            ["nom" => "Marque", "type_article_id" => 3],
        ]);
    }
}

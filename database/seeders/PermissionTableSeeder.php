<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["nom"=> "ajouter un client"],
            ["nom"=> "consulter un client"],
            ["nom"=> "editer un client"],

            ["nom"=> "ajouter une location"],
            ["nom"=> "consulter une location"],
            ["nom"=> "editer une location"],

            ["nom"=> "ajouter un article"],
            ["nom"=> "consulter un article"],
            ["nom"=> "editer un article"]
        ]);
    }
}

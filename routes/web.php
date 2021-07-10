<?php

use App\Http\Livewire\Utilisateur;
use App\Http\Livewire\Client;
use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(["register"=>false]);

Route::group(
    [
        "middleware" => ["auth"]
    ],
    function(){

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(
            [
                "middleware" => ["auth.admin"],
                'as'=>'admin.'
            ],
            function(){

                Route::group(["prefix" => "habilitations", "as" => "habilitations."], function(){
                    Route::get("/utilisateurs", Utilisateur::class)->name("utilisateurs.index");
                });
            }
        );

        Route::group(
            [
                "middleware" => ["auth.employe"],
                'as'=>'employe.'
            ],
            function(){

                Route::group(["prefix" => "clients", "as" => "clients."], function(){
                    Route::get("/", Client::class)->name("index");
                });
            }
        );
    }
);


Route::fallback(function () {
    return redirect()->route("home");
});

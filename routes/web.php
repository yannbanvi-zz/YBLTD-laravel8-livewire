<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\ArticleComp;
use App\Http\Livewire\clientComp;
use App\Http\Livewire\TarifComp;
use App\Http\Livewire\TypeArticleComp;
use App\Http\Livewire\Utilisateurs;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Le groupe des routes relatives aux administrateurs uniquement
Route::group([
    "middleware" => ["auth", "auth.admin"],
    'as' => 'admin.'
], function(){

    Route::group([
        "prefix" => "habilitations",
        'as' => 'habilitations.'
    ], function(){

        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        //Route::get("/rolesetpermissions", [UserController::class, "index"])->name("rolespermissions.index");
        //

    });

    Route::group([
        "prefix" => "gestarticles",
        'as' => 'gestarticles.'
    ], function(){

        Route::get("/types", TypeArticleComp::class)->name("types");
        Route::get("/articles", ArticleComp::class)->name("articles");
        Route::get("/articles/{articleId}/tarifs", TarifComp::class)->name("articles.tarifs");

    });


});

Route::group([
    "middleware" => ["auth", "auth.employe"],
    'as' => 'employe.'
], function(){
    Route::get("/clients", clientComp::class)->name("clients.index");
});



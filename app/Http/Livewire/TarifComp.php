<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\DureeLocation;
use App\Models\Tarification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TarifComp extends Component
{
    public Article $article;
    public $newTarif = [];
    public $isAddTarif = false;

    public function mount($articleId){
        
        $this->article = Article::find($articleId);
    }

    public function render()
    {
        return view('livewire.tarifs.index', [
            "tarifs" => Tarification::with(["dureeLocation"])
            ->whereArticleId($this->article->id) 
            ->get(),
            "dureeLocations" => DureeLocation::all()
        ])
        ->extends("layouts.master")
        ->section("contenu");
    }

    public function nouveauTarif(){
        $this->isAddTarif = true;
    }

    public function editTarif(Tarification $tarif){
        $this->isAddTarif = true;
        $this->newTarif = $tarif->toArray();
        $this->newTarif["edit"] = true;
    }

    public function saveTarif(){
        $articleId = $this->article->id;
        $newTarif = $this->newTarif;

        $uniqueRule = function() use($newTarif,$articleId){
            return (isset($newTarif["edit"]))?
            Rule::unique((new Tarification)->getTable(), "duree_location_id")
                ->ignore($newTarif["id"], "id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
                })
            : 
            Rule::unique((new Tarification)->getTable(), "duree_location_id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
                });
        };
        
        $this->validate([
            "newTarif.duree_location_id" => [
                "required",
                $uniqueRule()
            ],
            "newTarif.prix" => "required|numeric"
            ],
            ["newTarif.duree_location_id.unique" => "Il existe déjà un tarif pour cette durée location..."]
        );

        Tarification::updateOrCreate(
            [
                "duree_location_id" => $this->newTarif["duree_location_id"],
                "article_id" => $articleId
            ],
            [
                "prix" => $this->newTarif["prix"]
            ]
            );

            $this->cancel();

    }
    public function cancel(){
        $this->isAddTarif = false;
        $this->resetErrorBag();
        $this->newTarif = [];
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\TypeArticle;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TypeArticleComp extends Component
{
    use WithPagination;

    public $search = "";
    public $isAddTypeArticle = false;
    public $newTypeArticleName = "";
    public $newValue = "";

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        Carbon::setLocale("fr");

        $searchCriteria = "%".$this->search."%";

        $data = [
            "typearticles" => TypeArticle::where("nom", "like", $searchCriteria)->latest()->paginate(5)
        ];
        return view('livewire.typearticles.index', $data)
                ->extends("layouts.master")
                ->section("contenu");
    }

    public function toggleShowAddTypeArticleForm(){
         if($this->isAddTypeArticle){
            $this->isAddTypeArticle = false;
            $this->newTypeArticleName = "";
            $this->resetErrorBag(["newTypeArticleName"]);
         }else{
            $this->isAddTypeArticle = true;
         }
    }

    public function addNewTypeArticle(){
        $validated = $this->validate([
            "newTypeArticleName" => "required|max:50|unique:type_articles,nom"
        ]);

        TypeArticle::create(["nom"=> $validated["newTypeArticleName"]]);

        $this->toggleShowAddTypeArticleForm();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article ajouté à jour avec succès!"]);

    }

    public function editTypeArticle(TypeArticle $typeArticle){
        $this->dispatchBrowserEvent("showEditForm", ["typearticle" => $typeArticle]);
    }

    public function updateTypeArticle(TypeArticle $typeArticle, $valueFromJS){
        $this->newValue = $valueFromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("type_articles", "nom")->ignore($typeArticle->id)]
        ]);

        $typeArticle->update(["nom"=> $validated["newValue"]]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des types d'articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "type_article_id" => $id
            ]
        ]]);
    }
    public function deleteTypeArticle(TypeArticle $typeArticle){
        $typeArticle->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article supprimé avec succès!"]);
    }

}

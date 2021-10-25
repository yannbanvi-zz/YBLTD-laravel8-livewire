<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticlePropriete;
use App\Models\TypeArticle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArticleComp extends Component
{

    use WithPagination, WithFileUploads;

    protected $paginationTheme = "bootstrap";

    public $search = "";
    public $filtreType = "", $filtreEtat = "";
    public $addArticle = [];
    public $proprietesArticles = null;
    public $addPhoto = null;
    public $inputFileIterator = 0;



    public function render()
    {

        Carbon::setLocale("fr");

        $articleQuery = Article::query();

        if($this->search != ""){
            $articleQuery->where("nom", "LIKE",  "%". $this->search ."%")
                         ->orWhere("noSerie","LIKE",  "%". $this->search ."%");
        }

        if($this->filtreType != ""){
            $articleQuery->where("type_article_id", $this->filtreType);
        }

        if($this->filtreEtat != ""){
            $articleQuery->where("estDisponible", $this->filtreEtat);
        }


        return view('livewire.articles.index', [
            "articles" => $articleQuery->latest()->paginate(5),
            "typearticles"=> TypeArticle::orderBy("nom", "ASC")->get()
        ])
        ->extends("layouts.master")
        ->section("contenu");
    }

    public function updated($property){
        if($property == "addArticle.type"){
            $this->proprietesArticles = optional(TypeArticle::find($this->addArticle["type"]))->proprietes;
        }
    }

    public function showAddArticleModal(){
        $this->resetValidation();
        $this->addArticle = [];
        $this->proprietesArticles = [];
        $this->addPhoto = null;
        $this->inputFileIterator++;
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal");


    }

    public function editArticle(Article $article){

    }

    public function confirmDelete(Article $article){

    }

    public function ajoutArticle(){
        //dump($this->addArticle);

        $validateArr = [
            "addArticle.nom" => "string|min:3|required",
            "addArticle.noSerie" => "string|max:50|min:3|required",
            "addArticle.type" => "required",
            "addPhoto" => "image|max:10240" // 10mb

        ];

        $customErrMessages = [];
        $propIds = [];



        foreach ($this->proprietesArticles?: [] as $propriete) {

            $field = "addArticle.prop.".$propriete->nom;

            $propIds[$propriete->nom] = $propriete->id;


            if($propriete->estObligatoire == 1){
                $validateArr[$field] = "required";
                $customErrMessages["$field.required"] = "Le champ <<".$propriete->nom.">> est obligatoire.";
            }else{
                $validateArr[$field] = "nullable";
            }


        }

        // Validation des erreurs
        $validatedData = $this->validate($validateArr, $customErrMessages);
        $imagePath = "";

        if($this->addPhoto != null){

            $imagePath = $this->addPhoto->store('upload', 'public');

            $image = Image::make(public_path("storage/".$imagePath))->fit(200, 200);
            $image->save();

        }

        $article = Article::create([
            "nom" => $validatedData["addArticle"]["nom"],
            "noSerie" => $validatedData["addArticle"]["noSerie"],
            "type_article_id" => $validatedData["addArticle"]["type"],
            "imageUrl" => $imagePath
        ]);



        foreach($validatedData["addArticle"]["prop"]?: [] as $key => $prop){
            ArticlePropriete::create([
                "article_id" => $article->id,
                "propriete_article_id" => $propIds[$key],
                "valeur"=> $prop
            ]);
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Article ajouté avec succès!"]);

        $this->closeModal();


    }

    protected function cleanupOldUploads(){

        $storage = Storage::disk("local");

        foreach($storage->allFiles("livewire-tmp") as $pathFileName){

            if(! $storage->exists($pathFileName)) continue;

            $fiveSecondsDelete = now()->subSeconds(5)->timestamp;

            if($fiveSecondsDelete > $storage->lastModified($pathFileName)){
                $storage->delete($pathFileName);
            }
        }
    }
}

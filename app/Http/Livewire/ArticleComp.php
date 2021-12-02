<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticlePropriete;
use App\Models\TypeArticle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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
    public $editArticle = [];
    public $proprietesArticles = null;
    public $addPhoto = null;
    public $editPhoto = null;
    public $inputFileIterator = 0;
    public $inputEditFileIterator = 0;
    public $editHasChanged;
    public $editArticleOldValues = [];

    protected function rules () {
        return [
            'editArticle.nom' => ["required", Rule::unique("articles", "nom")->ignore($this->editArticle["id"])],
            'editArticle.noSerie' => ["required", Rule::unique("articles", "noSerie")->ignore($this->editArticle["id"])],
            'editArticle.type_article_id' => 'required|exists:App\Models\TypeArticle,id',
            'editArticle.article_proprietes.*.valeur' => 'required',
        ];
    } 

    

    function showUpdateButton(){
        $this->editHasChanged = false;

        foreach ($this->editArticleOldValues["article_proprietes"] as $index => $editArticleOld) {
            if($this->editArticle["article_proprietes"][$index]["valeur"] != $editArticleOld["valeur"]){
                $this->editHasChanged = true;
            }
        }

        if(
            $this->editArticle["nom"] != $this->editArticleOldValues["nom"] ||
            $this->editArticle["noSerie"] != $this->editArticleOldValues["noSerie"] ||
            $this->editPhoto != null
        ){
            $this->editHasChanged = true;
        }

    }

    public function render()
    {

        Carbon::setLocale("fr");

        $articleQuery = Article::query();

        if($this->search != ""){
            $this->resetPage();
            $articleQuery->where("nom", "LIKE",  "%". $this->search ."%")
                         ->orWhere("noSerie","LIKE",  "%". $this->search ."%");
        }

        if($this->filtreType != ""){
            $articleQuery->where("type_article_id", $this->filtreType);
        }

        if($this->filtreEtat != ""){
            $articleQuery->where("estDisponible", $this->filtreEtat);
        }

        if($this->editArticle != []){
            $this->showUpdateButton();
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

    public function updateArticle(){
        $this->validate();

        $article = Article::find($this->editArticle["id"]);

        $article->fill($this->editArticle);

        if($this->editPhoto != null){
            $path = $this->editPhoto->store("upload", "public");
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);

            $image->save();

            Storage::disk("local")->delete(str_replace("storage/", "public/", $article->imageUrl));

            $article->imageUrl = $imagePath;
        }

        $article->save();

        collect($this->editArticle["article_proprietes"])
        ->each(
                fn($item) => ArticlePropriete::where([
                    "article_id" => $item["article_id"],
                    "propriete_article_id" => $item["propriete_article_id"]
                ])->update(["valeur" => $item["valeur"]])
            );

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=> "Article mis à jour avec succès!"]);
        $this->dispatchBrowserEvent("closeEditModal");
        
       
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


    public function closeEditModal(){
        
        $this->dispatchBrowserEvent("closeEditModal");
    }

    public function editArticle($articleId){
        $this->editArticle = Article::with("article_proprietes","article_proprietes.propriete", "type")->find($articleId)->toArray();

        $this->editArticleOldValues = $this->editArticle;

        $this->editPhoto = null;
        $this->inputEditFileIterator++;
       
        $this->dispatchBrowserEvent("showEditModal");
    }

    public function confirmDelete(Article $article){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer ". $article->nom ." de la liste des articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "article_id" => $article->id
            ]
        ]]); 
    }

    public function ajoutArticle(){
        //dump($this->addArticle);

        $validateArr = [
            "addArticle.nom" => "string|min:3|required|unique:articles,nom",
            "addArticle.noSerie" => "string|max:50|min:3|required|unique:articles,noSerie",
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

        // par défaut notre image est une placeholder
        $imagePath = "images/imageplaceholder.png";

        if($this->addPhoto != null){

            $path = $this->addPhoto->store('upload', 'public');
            $imagePath = "storage/".$path;

            $image = Image::make(public_path($imagePath))->fit(200, 200);
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

    public function deleteArticle(Article $article){
        if(count($article->locations)>0) return;

        if(count($article->article_proprietes) > 0)
            $article->article_proprietes()->where("article_id", $article->id)->delete();
        
        if(count($article->tarifications) > 0)
            $article->tarifications()->where("article_id", $article->id)->delete();

        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Article supprimé avec succès!"]);
    }
}

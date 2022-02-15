<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class clientComp extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    public $addClient = [];
    public $editClient = [];
    public $search = "";

    public function render()
    {

        Carbon::setLocale("fr");
        

        $query = Client::query();
        $search = $this->search;

        if(isset($search))
            $this->resetPage();

        $query->when($search != "", function($query) use($search){
            $query->where("nom", "like", "%{$search}%");
            $query->orWhere("prenom", "like", "%{$search}%");
        });

        return view('livewire.clients.index', [
            "clients" => $query->latest()->paginate(10)
        ])
        ->extends("layouts.master")
        ->section("contenu");
    }

    public function rules(){
        if($this->currentPage == PAGEEDITFORM){

            // 'required|email|unique:Clients,email Rule::unique("Clients", "email")->ignore($this->editClient['id'])
            return [
                'editClient.nom' => 'required',
                'editClient.prenom' => 'required',
                'editClient.sexe' => 'required',
                'editClient.adresse' => 'required',
                'editClient.ville' => 'required',
                'editClient.pays' => 'required',
                'editClient.nationalite' => 'required',
                'editClient.dateNaissance' => 'required',
                'editClient.lieuNaissance' => 'required',
                'editClient.email' => ['required', 'email', Rule::unique("clients", "email")->ignore($this->editClient['id']) ] ,
                'editClient.telephone1' => ['required', Rule::unique("clients", "telephone1")->ignore($this->editClient['id']) ]  ,
                'editClient.pieceIdentite' => ['required'],
                'editClient.sexe' => 'required',
                'editClient.noPieceIdentite' => ['required', Rule::unique("clients", "pieceIdentite")->ignore($this->editClient['id']) ],
            ];
        }

        return [
            'addClient.nom' => 'required',
            'addClient.prenom' => 'required',
            'addClient.sexe' => 'required',
            'addClient.adresse' => 'required',
            'addClient.ville' => 'required',
            'addClient.pays' => 'required',
            'addClient.nationalite' => 'required',
            'addClient.dateNaissance' => 'required',
            'addClient.lieuNaissance' => 'required',
            'addClient.email' => 'required|email|unique:Clients,email',
            'addClient.telephone1' => 'required|unique:Clients,telephone1',
            'addClient.pieceIdentite' => 'required',
            'addClient.sexe' => 'required',
            'addClient.noPieceIdentite' => 'required|unique:Clients,noPieceIdentite',
        ];
    }

    public function goToAddClient(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToEditClient($id){
        $this->editClient = Client::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }



    public function goToListClient(){
        $this->currentPage = PAGELIST;
        $this->editClient = [];
    }

    public function addClient(){

        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();

        //dump($validationAttributes);
        // Ajouter un nouvel utilisateur
        Client::create($validationAttributes["addClient"]);

        $this->addClient = [];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur créé avec succès!"]);
    }

    public function updateClient(){
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();


        Client::find($this->editClient["id"])->update($validationAttributes["editClient"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Client mis à jour avec succès!"]);

    }



    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des clients. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "client_id" => $id
            ]
        ]]);
    }

    public function deleteClient($id){
        Client::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Client supprimé avec succès!"]);
    }
}

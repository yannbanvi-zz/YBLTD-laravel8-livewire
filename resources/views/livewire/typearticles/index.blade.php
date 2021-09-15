<div>

    <div class="modal fade" id="modalProp" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gestion des caracteristique de "{{ optional($selectedTypeArticle)->nom }}" </h5>

                </div>
                <div class="modal-body">
                   <div class="d-flex my-4 bg-gray-light p-3">
                        <div class="d-flex flex-grow-1 mr-2">
                            <div class="flex-grow-1 mr-2">
                                <input type="text" placeholder="Nom" class="form-control">
                            </div>
                            <div class="flex-grow-1">
                                <select class="form-control">
                                    <option value="">--Champ Obligatoire--</option>
                                    <option value="true">OUI</option>
                                    <option value="false">NON</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success">Ajouter</button>
                   </div>
                   <table class="table table-bordered">
                        <thead class="bg-primary">
                            <th>Nom</th>
                            <th>Est obligatoire</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Marque</td>
                                <td>OUI</td>
                                <td>
                                    <button class="btn btn-link"> <i class="far fa-edit"></i> </button>
                                    <button class="btn btn-link"> <i class="far fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                   </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-4 pt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-gradient-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des types d'articles</h3>

                <div class="card-tools d-flex align-items-center ">
                <a class="btn btn-link text-white mr-4 d-block" wire:click="toggleShowAddTypeArticleForm"><i class="fas fa-user-plus"></i> Nouveau type d'article</a>
                  <div class="input-group input-group-md" style="width: 250px;">
                    <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th style="width:50%;">Type d'article</th>
                      <th style="width:20%;" class="text-center">Ajouté</th>
                      <th style="width:30%;" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @if ($isAddTypeArticle)
                            <tr>
                                <td colspan="2">
                                    <input type="text"
                                    wire:keydown.enter="addNewTypeArticle"
                                    class="form-control @error('newTypeArticleName') is-invalid @enderror"
                                    wire:model="newTypeArticleName" />
                                    @error('newTypeArticleName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="addNewTypeArticle"> <i class="fa fa-check"></i> Valider</button>
                                    <button class="btn btn-link" wire:click="toggleShowAddTypeArticleForm"> <i class="far fa-trash-alt"></i> Annuler</button>
                                </td>
                            </tr>
                        @endif
                        @foreach ($typearticles as $typearticle)
                            <tr>
                                <td>{{ $typearticle->nom }}</td>
                                <td class="text-center">{{ optional($typearticle->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="editTypeArticle({{$typearticle->id}})"> <i class="far fa-edit"></i> </button>

                                     <button class="btn btn-link" wire:click="showProp({{$typearticle->id}})"> <i class="fa fa-list"></i> propriétés</button>


                                    <button class="btn btn-link" wire:click="confirmDelete('{{$typearticle->nom}}', {{$typearticle->id}})"> <i class="far fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                    {{ $typearticles->links() }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>





</div>

<script>
    window.addEventListener("showEditForm",function(e){
        Swal.fire({
            title: "Edition d'un type d'article",
            input: 'text',
            inputValue: e.detail.typearticle.nom ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:'Modifier <i class="fa fa-check"></i>',
            cancelButtonText:'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                if (!value) {
                return 'Champ obligatoire'
                }

                @this.updateTypeArticle(e.detail.typearticle.id, value)
            }
        })
    })
</script>

<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {
            if(event.detail.message.data){
                @this.deleteTypeArticle(event.detail.message.data.type_article_id)
            }
        }
        })
    })

</script>

<script>
    window.addEventListener("showModal", event=>{
       $("#modalProp").modal({
           "show": true,
           "backdrop": "static"
       })
    })
    window.addEventListener("closeModal", event=>{
       $("#modalProp").modal("hide")
    })

</script>

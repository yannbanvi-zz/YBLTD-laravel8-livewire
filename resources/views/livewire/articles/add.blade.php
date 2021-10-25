<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout d'un article </h5>

                </div>
                <form wire:submit.prevent="ajoutArticle">
                <div class="modal-body">

                    <div class="d-flex">
                            <div class=" my-4 bg-gray-light p-3 flex-grow-1">
                                @if($errors->any())
                                        <div class="alert alert-danger">

                                            <h5><i class="icon fas fa-ban"></i> Erreurs!</h5>
                                            <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                @endif

                                <div class="form-group">
                                    <label for="">Nom</label>
                                    <input type="text" wire:model="addArticle.nom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Numero de serie</label>
                                    <input type="text" wire:model="addArticle.noSerie" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select  class="form-control" wire:model="addArticle.type">
                                        <option value=""></option>
                                        @foreach ($typearticles as $typearticle)
                                            <option value="{{$typearticle->id}}">{{ $typearticle->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Les champs dynamiques qui seront crées par rapport au type selectionné --}}
                                @if($proprietesArticles != null)
                                <p style="border: 1px dashed black;"></p>
                                <div class="my-3 bg-gray-light">
                                    @foreach($proprietesArticles as $propriete)
                                        <div class="form-group">
                                            <label for=""> {{$propriete->nom}} @if(!$propriete->estObligatoire) (optionel) @endif
                                            </label>

                                            @php
                                               $field = "addArticle.prop.".$propriete->nom;
                                            @endphp

                                            <input type="text" wire:model="{{ $field }}"  class="form-control">
                                        </div>
                                    @endforeach
                                </div>
                                @endif

                            </div>

                            <div class="p-4" >
                                        <div class="form-group">
                                            <input type="file" wire:model="addPhoto" id="image{{$inputFileIterator}}">
                                        </div>
                                        <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                                @if ($addPhoto)

                                                    <img src="{{ $addPhoto->temporaryUrl() }}" style="height:200px; width:200px;">
                                                @endif
                                        </div>
                             </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Ajouter</button>
                    <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
                </div>

                </form>

            </div>
        </div>
    </div>

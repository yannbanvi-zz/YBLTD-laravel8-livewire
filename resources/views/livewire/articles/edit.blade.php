<div class="modal fade" id="editModal" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition d'un article </h5>

            </div>
            <form wire:submit.prevent="updateArticle">
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
                                <input type="text" wire:model="editArticle.nom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Numero de serie</label>
                                <input type="text" wire:model="editArticle.noSerie" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select  class="form-control" wire:model="editArticle.type_article_id">
                                    <option value="{{ $editArticle["type_article_id"] }}">{{ $editArticle["type"]["nom"] }}</option>
                                    
                                </select>
                            </div>

                            {{-- Les champs dynamiques qui seront crées par rapport au type selectionné --}}
                            @if($editArticle["article_proprietes"] != [])
                            <p style="border: 1px dashed black;"></p>
                            <div class="my-3 bg-gray-light">
                                @foreach($editArticle["article_proprietes"] as $index => $articlePropriete)
                                    <div class="form-group">
                                        <label for=""> {{$articlePropriete["propriete"]["nom"]}} @if(!$articlePropriete["propriete"]["estObligatoire"]) (optionel) @endif
                                        </label>

                                        <input type="text" wire:model="editArticle.article_proprietes.{{ $index }}.valeur"  class="form-control">
                                    </div>
                                @endforeach
                            </div>
                            @endif

                        </div>

                        <div class="p-4" >
                                    <div class="form-group">
                                        <input type="file" wire:model="editPhoto" id="image{{$inputEditFileIterator}}">
                                    </div>
                                    <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                            @if (isset($editPhoto))

                                                <img src="{{ $editPhoto->temporaryUrl() }}" style="height:200px; width:200px;">

                                            @else

                                            <img src="{{ asset($editArticle["imageUrl"]) }}" style="height:200px; width:200px;">

                                            @endif
                                    </div>
                                    @isset($editPhoto)
                                    <div>
                                        <button
                                        type="button" 
                                        class="btn btn-default btn-sm mt-2"
                                        wire:click="$set('editPhoto', null)"
                                        >Réinitialiser</button>    
                                    </div> 
                                    @endisset
                         </div>
                </div>


            </div>
            <div class="modal-footer" >
               <div>
                @if( $editHasChanged)
                    <button type="submit" class="btn btn-success" >Valider les modifications</button>
                @endif
               </div> 
                    <button type="button" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
            </div>

            </form>

        </div>
    </div>
</div>

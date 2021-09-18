<div class="modal fade" id="editModalProp" style="z-index: 1900;" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl" style="top:100px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edition propriété </h5>

                </div>
                <div class="modal-body">
                   <div class="d-flex my-4 bg-gray-light p-3">
                        <div class="d-flex flex-grow-1 mr-2">
                            <div class="flex-grow-1 mr-2">
                                <input type="text" placeholder="Nom" wire:keypress.enter="updateProp()" wire:model="editPropModel.nom" class="form-control @error("editPropModel.nom") is-invalid @enderror">
                                @error("editPropModel.nom")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="flex-grow-1">
                                <select class="form-control @error("editPropModel.estObligatoire") is-invalid @enderror" wire:model="editPropModel.estObligatoire">
                                    <option value="">--Champ Obligatoire--</option>
                                    <option value="1">OUI</option>
                                    <option value="0">NON</option>
                                </select>
                                @error("editPropModel.estObligatoire")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                        <button class="btn btn-success" wire:click="updateProp()">Valider</button>
                        </div>
                   </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

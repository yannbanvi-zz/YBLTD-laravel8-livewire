<div class="row p-4 pt-5">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition client</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateClient()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input type="text" wire:model="editClient.nom"
                                class="form-control @error('editClient.nom') is-invalid @enderror">

                            @error('editClient.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Prenom</label>
                            <input type="text" wire:model="editClient.prenom"
                                class="form-control @error('editClient.prenom') is-invalid @enderror">

                            @error('editClient.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sexe</label>
                        <select class="form-control @error('editClient.sexe') is-invalid @enderror"
                            wire:model="editClient.sexe">
                            <option value="">---------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error('editClient.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" class="form-control @error('editClient.dateNaissance') is-invalid @enderror"
                            wire:model="editClient.dateNaissance">
                        @error('editClient.dateNaissance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Lieu de naissance</label>
                        <input type="text" class="form-control @error('editClient.lieuNaissance') is-invalid @enderror"
                            wire:model="editClient.lieuNaissance">
                        @error('editClient.lieuNaissance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nationalité</label>
                        <input type="text" class="form-control @error('editClient.nationalite') is-invalid @enderror"
                            wire:model="editClient.nationalite">
                        @error('editClient.nationalite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Adresse e-mail</label>
                        <input type="text" class="form-control @error('editClient.email') is-invalid @enderror"
                            wire:model="editClient.email">
                        @error('editClient.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Pays</label>
                        <input type="text" class="form-control @error('editClient.pays') is-invalid @enderror"
                            wire:model="editClient.pays">
                        @error('editClient.pays')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" class="form-control @error('editClient.ville') is-invalid @enderror"
                            wire:model="editClient.ville">
                        @error('editClient.ville')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control @error('editClient.adresse') is-invalid @enderror"
                            wire:model="editClient.adresse">
                        @error('editClient.adresse')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Telephone 1</label>
                            <input type="text" class="form-control @error('editClient.telephone1') is-invalid @enderror"
                                wire:model="editClient.telephone1">
                            @error('editClient.telephone1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Telephone 2</label>
                            <input type="text" class="form-control" wire:model="editClient.telephone2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Piece d'identité</label>
                        <select class="form-control @error('editClient.pieceIdentite') is-invalid @enderror"
                            wire:model="editClient.pieceIdentite">
                            <option value="">---------</option>
                            <option value="CNI">CNI</option>
                            <option value="PASSPORT">PASSPORT</option>
                            <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                        </select>
                        @error('editClient.pieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Numero de piece d'identité</label>
                        <input type="text"
                            class="form-control @error('editClient.numeroPieceIdentite') is-invalid @enderror"
                            wire:model="editClient.noPieceIdentite">
                        @error('editClient.noPieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListClient()" class="btn btn-danger">Retouner à la liste des
                        clients</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>

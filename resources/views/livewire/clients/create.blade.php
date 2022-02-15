<div class="row p-4 pt-5">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'ajout de client</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="addClient()" method="POST">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input type="text" wire:model="addClient.nom"
                                class="form-control @error('addClient.nom') is-invalid @enderror">

                            @error('addClient.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Prenom</label>
                            <input type="text" wire:model="addClient.prenom"
                                class="form-control @error('addClient.prenom') is-invalid @enderror">

                            @error('addClient.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sexe</label>
                        <select class="form-control @error('addClient.sexe') is-invalid @enderror"
                            wire:model="addClient.sexe">
                            <option value="">---------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error('addClient.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" class="form-control @error('addClient.dateNaissance') is-invalid @enderror"
                            wire:model="addClient.dateNaissance">
                        @error('addClient.dateNaissance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Lieu de naissance</label>
                        <input type="text" class="form-control @error('addClient.lieuNaissance') is-invalid @enderror"
                            wire:model="addClient.lieuNaissance">
                        @error('addClient.lieuNaissance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nationalité</label>
                        <input type="text" class="form-control @error('addClient.nationalite') is-invalid @enderror"
                            wire:model="addClient.nationalite">
                        @error('addClient.nationalite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Adresse e-mail</label>
                        <input type="text" class="form-control @error('addClient.email') is-invalid @enderror"
                            wire:model="addClient.email">
                        @error('addClient.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Pays</label>
                        <input type="text" class="form-control @error('addClient.pays') is-invalid @enderror"
                            wire:model="addClient.pays">
                        @error('addClient.pays')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" class="form-control @error('addClient.ville') is-invalid @enderror"
                            wire:model="addClient.ville">
                        @error('addClient.ville')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control @error('addClient.adresse') is-invalid @enderror"
                            wire:model="addClient.adresse">
                        @error('addClient.adresse')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Telephone 1</label>
                            <input type="text" class="form-control @error('addClient.telephone1') is-invalid @enderror"
                                wire:model="addClient.telephone1">
                            @error('addClient.telephone1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Telephone 2</label>
                            <input type="text" class="form-control" wire:model="addClient.telephone2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Piece d'identité</label>
                        <select class="form-control @error('addClient.pieceIdentite') is-invalid @enderror"
                            wire:model="addClient.pieceIdentite">
                            <option value="">---------</option>
                            <option value="CNI">CNI</option>
                            <option value="PASSPORT">PASSPORT</option>
                            <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                        </select>
                        @error('addClient.pieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Numero de piece d'identité</label>
                        <input type="text"
                            class="form-control @error('addClient.numeroPieceIdentite') is-invalid @enderror"
                            wire:model="addClient.noPieceIdentite">
                        @error('addClient.noPieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" wire:click="goToListClient()" class="btn btn-danger">Retouner à la liste des
                        clients</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>

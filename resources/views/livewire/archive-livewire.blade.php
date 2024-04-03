<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Archives <div wire:offline class="badge-warning">(Hors ligne)</div></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Archives</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    {{-- @if($isOpen) --}}

    <div wire:ignore.self class="modal" id="enreg-modal-lg" data-backdrop='false' aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0">
            <div class="card">
              <form method="POST" wire:submit.prevent="store()">
                <!-- SELECT2 EXAMPLE -->
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">{{ $modal_title }}</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div  class="form-group" >
                        <label>Client</label>
                        <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" autocomplete="off" style="width: 100%;" wire:model="user_id" {{ $show_flag == 1 ? 'disabled' : '' }}>
                          <option value="" selected >-- Selectionner le client --</option>
                          @foreach($clients AS $client)
                            <option {{ strval($client->id) == strval($client_id) ? 'selected' : '' }} value="{{ $client->id  }}">{{ $client->name }}</option>
                          @endforeach
                        </select>
                        {{-- <select id="user_id" class="@error('user_id') is-invalid @enderror" autocomplete="off" style="width: 100%;" wire:model="user_id" {{ $show_flag == 1 ? 'disabled' : '' }}>
                          <option disabled selected>-- Select --</option>
                          @foreach($clients AS $client)
                            <option >{{ $user_id }}</option>
                          @endforeach
                        </select> --}}
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <div class="form-group">
                        {{-- <input type="text" class="form-control" wire:model="user_id" placeholder="Wagon" {{ $show_flag == 1 ? 'disabled' : '' }}> --}}
                      </div>
                    
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3">
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="num_wagon">Wagon</label>
                        <input type="text" class="form-control @error('num_wagon') is-invalid @enderror" autocomplete="off" id="num_wagon" wire:model="num_wagon" placeholder="Wagon" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_wagon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label for="num_tc">N° TC</label>
                        <input type="text" class="form-control @error('num_tc') is-invalid @enderror" autocomplete="off" id="num_tc" wire:model="num_tc" placeholder="N° TC" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_tc') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="num_dossier">N° Dossier</label>
                        <input type="text" class="form-control @error('num_dossier') is-invalid @enderror" autocomplete="off" id="num_dossier" wire:model="num_dossier" placeholder="N° Dossier" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_dossier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label for="posit_plomb">POSIT/PLOMB</label>
                        <input type="text" class="form-control @error('posit_plomb') is-invalid @enderror" autocomplete="off" id="posit_plomb" wire:model="posit_plomb" placeholder="Posit/Plomb" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('posit_plomb') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" autocomplete="off" id="type" wire:model="type" placeholder="Type" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label for="poids">Poids</label>
                        <input type="text" class="form-control @error('poids') is-invalid @enderror" autocomplete="off" id="poids" wire:model="poids" placeholder="poids" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('poids') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" class="form-control @error('destination') is-invalid @enderror" autocomplete="off" id="destination" wire:model="destination" placeholder="Destination" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('destination') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="date_entree">Date Entrée</label>
                        <input type="date" class="form-control @error('date_entree') is-invalid @enderror" autocomplete="off" id="date_entree" wire:model="date_entree" placeholder="Date Entrée" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('date_entree') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="position_actu">Position Actualisée</label>
                        {{-- <input type="position_actu" class="form-control @error('position_actu') is-invalid @enderror" autocomplete="off" id="position_actu" wire:model="position_actu" placeholder="Position Actualisée" {{ $show_flag == 1 ? 'disabled' : '' }}> --}}
                        <select id="position_actu" class="form-control @error('position_actu') is-invalid @enderror" autocomplete="off" style="width: 100%;" wire:model="position_actu" {{ $show_flag == 1 ? 'disabled' : '' }}>
                          <option selected>-- Position Act --</option>
                          <option value="NC">NC</option>
                          <option value="Pret">Prèt</option>
                          <option value="Abidjan">Abidjan</option>
                          <option value="Dimbokro">Dimbokro</option>
                          <option value="Bouake">Bouaké</option>
                          <option value="Ferkessedougou">Ferkessédougou</option>
                          <option value="Koudougou">Koudougou</option>
                          <option value="Ouagadougou">Ouagadougou</option>
                        </select>
                        @error('position_actu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="date_sortie">Date Sortie</label>
                        <input type="date" class="form-control @error('date_sortie') is-invalid @enderror" autocomplete="off" id="date_sortie" wire:model="date_sortie" placeholder="Date Sortie" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('date_sortie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">                        
                      <div class="form-group">
                        <label for="date_entree">Train</label>
                        <input type="text" class="form-control @error('train') is-invalid @enderror" autocomplete="off" id="train" wire:model="train" placeholder="Train" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('train') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="consignataire">Consignataire</label>
                        <input type="text" class="form-control @error('consignataire') is-invalid @enderror" autocomplete="off" id="consignataire" wire:model="consignataire" placeholder="Consignataire" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('consignataire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row">
                    <div class="col-md-4">                        
                      <div class="form-group">
                        <label for="destinataire">Destinataire</label>
                        <input type="text" class="form-control @error('destinataire') is-invalid @enderror" autocomplete="off" id="destinataire" wire:model="destinataire" placeholder="Destinataire" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('destinataire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="montant_facture">Montant Facture</label>
                        <input type="number" min="0" class="form-control @error('montant_facture') is-invalid @enderror" autocomplete="off" id="montant_facture" wire:model="montant_facture" placeholder="Montant Facture" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('montant_facture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label for="chauffeur">Chauffeur</label>
                        <input type="text" class="form-control @error('chauffeur') is-invalid @enderror" autocomplete="off" id="chauffeur" wire:model="chauffeur" placeholder="Chauffeur" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('chauffeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">                        
                      <div class="form-group">
                        <label for="type_marchandise">Type Marchandise</label>
                        <input type="text" class="form-control @error('type_marchandise') is-invalid @enderror" autocomplete="off" id="type_marchandise" wire:model="type_marchandise" placeholder="Type Marchandise" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('type_marchandise') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="percepteur">Percepteur</label>
                        <input type="text" class="form-control @error('percepteur') is-invalid @enderror" autocomplete="off" id="percepteur" wire:model="percepteur" placeholder="Percepteur" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('percepteur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="num_bon">N° Bon</label>
                        <input type="text" class="form-control @error('num_bon') is-invalid @enderror" autocomplete="off" id="num_bon" wire:model="num_bon" placeholder="N° Bon" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_bon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">                        
                      <div class="form-group">
                        <label for="num_facture">N° Facture</label>
                        <input type="text" class="form-control @error('num_facture') is-invalid @enderror" autocomplete="off" id="num_facture" wire:model="num_facture" placeholder="N° Facture" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_facture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="num_declaration">N° Déclaration</label>
                        <input type="text" class="form-control @error('num_declaration') is-invalid @enderror" autocomplete="off" id="num_declaration" wire:model="num_declaration" placeholder="N° Déclaration" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_declaration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="num_chauffeur">N° Chauffeur</label>
                        <input type="text" class="form-control @error('num_chauffeur') is-invalid @enderror" autocomplete="off" id="num_chauffeur" wire:model="num_chauffeur" placeholder="N° Chauffeur" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_chauffeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-md-4">
                      <!-- /.form-group -->                        
                      <div class="form-group">
                        <label for="num_camion">N° Camion</label>
                        <input type="text" class="form-control @error('num_camion') is-invalid @enderror" autocomplete="off" id="num_camion" wire:model="num_camion" placeholder="N° Camion" {{ $show_flag == 1 ? 'disabled' : '' }}>
                        @error('num_camion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
              </div>
            </form>
          </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            @if(!$show_flag)
              <button type="button" class="btn btn-primary" wire:click.prevent="store()">Enregister</button>
            @endif
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    


  

    <div wire:ignore.self class="modal" id="import-modal-lg" data-backdrop='false' aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0">
            
              <form method="POST" wire:submit.prevent="import()">
                @csrf
                          <!-- SELECT2 EXAMPLE -->
                
                  <div class="card-header">
                    <h3 class="card-title">{{ $modal_title }}</h3>
        
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- /.row -->
                    
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
            
                            <div class="form-group">
                                <label for="file">Choisir un fichier Excel</label>
                                <input type="file" id="file" wire:model="file" class="form-control @error('file') is-invalid @enderror">
                                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                
              </form>
        
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" wire:click.prevent="import()">Enregister</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>




    {{-- @else --}}
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @role('Super-Admin|Admin|User')
                <div class="row">
                  <div class="col-4">
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="position_actu">Filter par client</label>
                      <select id="client_fliter" class="form-control @error('client_fliter') is-invalid @enderror" style="width: 100%;" wire:model.live="client_fliter">
                        <option selected >-- Selectionner le client --</option>
                        @foreach($clients AS $client)
                          <option value="{{ $client->name  }}">{{ $client->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                  </div>
                </div>
                </br>
                @endrole
                <div class="row">
                  <div class="col-2">
                    <button type="button" wire:click="new()" class="btn btn-dark" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-plus pr-1"></i>Nouveau</button>                    
                      {{-- <button wire:click="create()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Nouveau</button> --}}
                  </div>
                  <div class="col-4">
                      <label for="position_actu">Recherche</label>
                      <input type="text" wire:model.live="searchTerm" placeholder="Rechercher ..." class="form-control">
                  </div>
                  <div class="col-2">
                      <label for="position_actu">Date Debut</label>
                      <input type="date" wire:model.live="dDebut" placeholder="Date Debut." class="form-control">
                  </div>
                  <div class="col-2">
                      <label for="position_actu">Date Fin</label>
                      <input type="date" wire:model.live="dFin" placeholder="Date Fin ..." class="form-control">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#import-modal-lg"><i class="fas fa-plus pr-1"></i>Importer(Excel)</button>                    
                      {{-- <button wire:click="create()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Nouveau</button> --}}
                  </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- @if( $lists->count() < $this->paginatedPerPages )
                <p>Try your first CRUD now!</p>
                @else
                    <p>Now you have more data to work arround. Try to find data from 'Base', 'String' or 'Textarea' column using Search Bar, right above ^^</p>
                @endif --}}
                <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Wagon</th>
                    <th>N° Dossier</th>
                    <th>Type</th>
                    <th>N° TC</th>
                    <th>Posit/Plomb</th>
                    <th>Poids</th>
                    <th>Dest</th>
                    <th>Client</th>
                    <th>Train</th>
                    <th>Position Act</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    {{-- <tr>
                      <td ></td>
                      <td >
                      <input type="text" wire:model="searchTerm" placeholder="Search Something...">
                      </td>
                      <td class="text-left">
                      </td>
                      <td class="text-left"></td>
                      <td class="text-left">
                      </td>
                      <td class="text-left"></td>
                      <td class="text-left"></td>
                      <td class="text-left"></td>
                      <td class="text-left">
                        <input type="text" wire:model="searchTerm" placeholder="Search Something...">
                      </td>
                      <td ></td>
                    <tr> --}}
                    @isset($lists)
                    @foreach($lists as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $list->num_wagon }}</td>
                        <td class="text-left">{{ $list->num_dossier }}</td>
                        <td class="text-left">{{ $list->type }}</td>
                        <td class="text-left">{{ $list->num_tc }}</td>
                        <td class="text-left">{{ $list->posit_plomb }}</td>
                        <td class="text-left">{{ $list->poids }}</td>
                        <td class="text-left">{{ $list->destination }}</td>
                        {{-- <td class="text-left">{{ $list->destination }}</td> --}}
                        <td class="text-left">{{ $list->user->name }}</td>
                        <td class="text-left">{{ $list->train }}</td>
                        <td class="text-left">{{ $list->position_actu }}</td>
                        {{-- <td>{{ number_format( $list->num_wagon ) }}</td> --}}
                        {{-- <td class="text-left">{{ $list->num_wagon }}</td> --}}
                        {{-- <td>
                        </td> --}}
                          <td>
                            <button wire:click="show({{ $list->enreg_id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#enreg-modal-lg" title="Voir"><i class="fas fa-eye"></i></button>
                            {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-plus pr-1"></i>Nouveau</button>                     --}}
                            @role('Super-Admin|Admin|User')
                            <button wire:click="edit({{ $list->enreg_id }})" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#enreg-modal-lg" title="Modifier"><i class="fas fa-edit"></i></button>
                            {{-- <button wire:click="valide({{ $list->enreg_id }})" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button> --}}
                            {{-- <button wire:click="delete({{ $list->enreg_id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button> --}}
                          @endrole
                        </td>
                      </tr>
                    @endforeach
                    @endisset
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Wagon</th>
                    <th>N° Dossier</th>
                    <th>Type</th>
                    <th>N° TC</th>
                    <th>Posit/Plomb</th>
                    <th>Poids</th>
                    <th>Dest</th>
                    <th>Client</th>
                    <th>Train</th>
                    <th>Position Act</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
                </div>
                @if($lists->hasPages())
                  {{ $lists->links() }}
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  
    <!-- /.content -->
  </div>
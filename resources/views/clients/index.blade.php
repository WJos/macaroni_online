@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comptes client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Comptes clients</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->   

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-6">
                    <a href="{{ route('clients.create') }}" type="button"  class="btn btn-dark" ><i class="fas fa-plus pr-1"></i>Nouveau</a>                    
                      {{-- <button wire:click="create()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Nouveau</button> --}}
                  </div>
                  {{-- <div class="col-6">
                      <input type="text" wire:model="searchTerm" placeholder="Search Something..." class="form-control">
                  </div> --}}
              </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- @if( $clients->count() < $this->paginatedPerPages )
                <p>Try your first CRUD now!</p>
                @else
                    <p>Now you have more data to work arround. Try to find data from 'Base', 'String' or 'Textarea' column using Search Bar, right above ^^</p>
                @endif --}}
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Contact</th>
                    {{-- <th>Role</th> --}}
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @isset($clients)
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $client->name }}</td>
                        <td class="text-left">{{ $client->email }}</td>
                        <td class="text-left">{{ $client->contact }}</td>
                        {{-- <td class="text-left">{{ $client->roles[0]->name }}</td>                         --}}
                        <td>
                            {{-- <button wire:click="show({{ $client->enreg_id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-eye"></i></button> --}}
                            {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-plus pr-1"></i>Nouveau</button>                     --}}

                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning" ><i class="fas fa-edit" alt="Modifier"></i></a>
                            <a href="{{ route('client_statut', $client->id) }}" class="btn btn-sm @if($client->statut) btn-success @else btn-secondary @endif" ><i class="fas fa-key" alt="Activer|Désactiver"></i></a>
                            <a href="{{ route('client_supp', $client->id) }}" class="btn btn-sm btn-danger" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Contact</th>
                    {{-- <th>Role</th> --}}
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
                </div>
                {{-- @isset($clients)
                @if($clients->hasPages())
                  {{ $clients->links() }}
                @endif
                @endisset --}}
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
  {{-- @endif --}}
    <!-- /.content -->
  </div>
  @endsection
@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comptes utilisateurs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Comptes utilisateurs</li>
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
                    <a href="{{ route('users.create') }}" type="button"  class="btn btn-dark" ><i class="fas fa-plus pr-1"></i>Nouveau</a>                    
                      {{-- <button wire:click="create()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Nouveau</button> --}}
                  </div>
                  <div class="col-6">
                      <input type="text" wire:model="searchTerm" placeholder="Search Something..." class="form-control">
                  </div>
              </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- @if( $users->count() < $this->paginatedPerPages )
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
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @isset($users)
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $user->name }}</td>
                        <td class="text-left">{{ $user->email }}</td>
                        <td class="text-left">{{ $user->contact }}</td>
                        <td class="text-left">{{ $user->roles[0]->name }}</td>                        
                        <td>
                            {{-- <button wire:click="show({{ $user->enreg_id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-eye"></i></button> --}}
                            {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#enreg-modal-lg"><i class="fas fa-plus pr-1"></i>Nouveau</button>                     --}}

                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" ><i class="fas fa-edit" alt="Modifier"></i></a>
                            <a href="{{ route('user_statut', $user->id) }}" class="btn btn-sm @if($user->statut) btn-success @else btn-secondary @endif" ><i class="fas fa-key" alt="Activer|Désactiver"></i></a>
                            @role('Super-Admin')
                            <a href="{{ route('user_supp', $user->id) }}" class="btn btn-sm btn-danger" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></a>
                            @endrole
                            
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
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
                </div>
                {{-- @isset($users)
                @if($users->hasPages())
                  {{ $users->links() }}
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
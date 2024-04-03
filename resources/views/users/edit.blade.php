@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <div class="col-md-3">
            </div>
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                {{-- <h3 class="card-title">Quick Example</h3> --}}
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('users.update', $user->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nom</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="form-control">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input id="contact" name="contact" type="text" value="{{ old('contact', $user->contact) }}" required autocomplete="Contact" class="form-control">
                    @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                  <div class="form-group">
                    <label class="form-label">Role</label>
                    <select id="roles"  class="form-select" name="roles">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregister</button>
                  @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Enregisté.') }}</p>
                @endif
                </div>
              </form>
            </div>
            <div class="col-md-3">
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

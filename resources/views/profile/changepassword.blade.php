@extends('adminlte::page')

@section('title', 'Modifier le mot de passe')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Modifier le mot de passe</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Modifier le mot de passe</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Notifications for success and error messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Form Start -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Changer le mot de passe</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password.change') }}" method="POST">
                        @csrf
                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="current_password" class="font-weight-bold">Mot de passe actuel</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Entrez votre mot de passe actuel" required>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="new_password" class="font-weight-bold">Nouveau mot de passe</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Entrez le nouveau mot de passe" required>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group">
                            <label for="new_password_confirmation" class="font-weight-bold">Confirmer le nouveau mot de passe</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                </div>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirmez le nouveau mot de passe" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-save mr-2"></i>Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Form End -->
        </div>
    </div>
</div>
@stop

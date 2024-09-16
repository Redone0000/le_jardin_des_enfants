@extends('adminlte::page')

@section('title', 'Dashboard')

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
        <p class="m-0 ">/</p>
        <p class="m-0">modifier le mot de passe</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('profile.password.change') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">nouveau mot de passe</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@stop

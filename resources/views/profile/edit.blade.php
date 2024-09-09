@extends('adminlte::page')

@section('title', 'Liste des Événements')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Profile</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Profile</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
<h1>Mise à jour du profil</h1>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname }}">
            </div>

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $user->firstname }}">
            </div>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control" value="{{ $user->login }}">
            </div>

            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>

             <!-- Champs supplémentaires pour le rôle de tuteur -->
            @if($user->role_id == 2)
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ $user->teacher->description }}</textarea>
                </div>

                <!-- Image existante -->
                @if ($user->teacher->picture)
                    <div class="mb-3">
                        <label>{{ __('Ancienne Photo') }}</label><br>
                        <img src="{{ asset('storage/' . $user->teacher->picture) }}" alt="Photo" width="10%">
                    </div>
                @endif

                <!-- picture -->
                <div class="mb-3">
                    <label for="picture" class="form-label">{{ __('Photo') }}</label>
                    <input id="picture" class="form-control" type="file" name="picture" accept="image/*"/>
                    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                </div>
            @endif

            @if($user->role_id == 3)
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <textarea name="address" id="address" class="form-control">{{ $user->tutor->address }}</textarea>
                </div>

                <div class="form-group">
                    <label for="emergency_contact_name">Nom du contact d'urgence</label>
                    <textarea name="emergency_contact_name" id="emergency_contact_name" class="form-control">{{ $user->tutor->emergency_contact_name }}</textarea>
                </div>

                <div class="form-group">
                    <label for="emergency_contact_phone">Numéro de téléphone du contact d'urgence</label>
                    <textarea name="emergency_contact_phone" id="emergency_contact_phone" class="form-control">{{ $user->tutor->emergency_contact_phone }}</textarea>
                </div>

            @endif

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
</div>
@stop

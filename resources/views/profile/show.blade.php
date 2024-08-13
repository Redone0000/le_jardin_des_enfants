@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Profil</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="{{ route('home') }}">Accueil</a></p>
        <p class="m-0">/</p>
        <p class="m-0">Profil</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <!-- Section Profil Utilisateur -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ $user->firstname }} {{ $user->lastname }}</h4>
                </div>
                <div class="card-body text-center">
                    <p><i class="fas fa-envelope"></i> Email : {{ $user->email }}</p>
                    <p><i class="fas fa-phone"></i> Téléphone : {{ $user->phone }}</p>
                </div>
            </div>
            <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn-sm btn-info">Mettre à jour</a>
        </div>

        <!-- Section Détails Spécifiques au Rôle -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Détails du Profil</h4>
                </div>
                <div class="card-body">
                    @if($role == 1)
                        <p class="text-center">Informations spécifiques à ce rôle à venir.</p>
                    @elseif($role == 2)
                        <p><i class="fas fa-info-circle"></i> <strong>Description :</strong> {{ $user->teacher->description }}</p>
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $user->teacher->picture) }}" alt="Photo" class="rounded img-fluid mb-3">
                        </div>
                    @elseif($role == 3)
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse :</strong> {{ $user->tutor->address }}</p>
                        <p><i class="fas fa-user-shield"></i> <strong>Nom du contact d'urgence :</strong> {{ $user->tutor->emergency_contact_name }}</p>
                        <p><i class="fas fa-phone-alt"></i> <strong>Numéro de téléphone d'urgence :</strong> {{ $user->tutor->emergency_contact_phone }}</p>
                        
                        <hr>

                <h5>Enfants</h5>
                @foreach($user->tutor->children as $child)
                    <div class="card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h4><strong>{{ $child->lastname }} {{ $child->firstname }}</strong></h4>
                                <p><i class="fas fa-venus-mars"></i> Sexe : {{ $child->sexe }}</p>
                                <p><i class="fas fa-birthday-cake"></i> Date de naissance : {{ $child->birth_date }}</p>
                                <a href="{{ route('child.show', $child->id) }}" class="btn-sm btn-primary">Voir</a>
                                <a href="{{ route('child.edit', $child->id) }}" class="btn-sm btn-info">Mettre à jour</a>
                            </div>
                            <div class="ml-3">
                                <img src="{{ asset('storage/' . $child->picture) }}" alt="Photo" class="" width="100">
                            </div>
                        </div>
                    </div>
                @endforeach

                    @else
                        <p class="text-center text-danger">Rôle inconnu. Veuillez contacter l'administrateur.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

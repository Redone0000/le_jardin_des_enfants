@extends('adminlte::page')

@section('title', 'Détails de l\'Événement')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-success mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Détails de l'Événement</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="{{ route('event.index') }}">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Détails</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>{{ $event->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Créé le:</strong> {{ $event->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Mis à jour le:</strong> {{ $event->updated_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('event.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <a href="" class="btn btn-warning">Modifier</a>
            <form action="" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@stop

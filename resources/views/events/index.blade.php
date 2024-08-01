@extends('adminlte::page')

@section('title', 'Liste des Événements')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Liste des Événements</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="{{ route('event.index') }}">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Événements</p>
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

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('event.create') }}" class="btn btn-primary">Créer un Nouvel Événement</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Créé le</th>
                            <th>Mis à jour le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $event->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

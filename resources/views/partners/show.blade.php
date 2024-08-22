@extends('adminlte::page')

@section('title', 'Détails du Partenaire')

@section('content_header')
    <h1>Détails du Partenaire</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $partner->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($partner->picture)
                            <img src="{{ asset('storage/' . $partner->picture) }}" alt="Photo" class="img-fluid rounded">
                        @else
                            <img src="{{ asset('storage/partners/default.png') }}" alt="Photo" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Nom</th>
                                    <td>{{ $partner->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $partner->description ?? 'Non spécifié' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Adresse</th>
                                    <td>{{ $partner->address ?? 'Non spécifié' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Téléphone</th>
                                    <td>{{ $partner->phone ?? 'Non spécifié' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Web</th>
                                    <td>
                                        @if ($partner->website)
                                            <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
                                        @else
                                            Non spécifié
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('partners.index') }}" class="btn btn-secondary">Retour à la liste</a>
                <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary">Modifier</a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 0.5rem;
        }
        
        .card-header {
            background-color: #007bff; /* Couleur primaire */
            border-bottom: 1px solid #ddd;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }
        
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        
        .rounded {
            border-radius: 0.25rem;
        }
    </style>
@stop

@section('js')
@stop

@extends('adminlte::page')

@section('title', 'Afficher l\'enfant')

@section('content_header')
    <h1>Détails de l'Enfant</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $child->firstname }} {{ $child->lastname }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('storage/' . $child->picture) }}" alt="Photo de l'enfant" class="img-fluid rounded-circle" width="200">
                        <div class="mt-3">
                            <a href="{{ route('child.edit', $child->id) }}" class="btn btn-info mb-2">Mettre à jour</a>
                            <a href="mailto:{{ $child->tutor->user->email }}" class="btn btn-success mb-2">Contacter {{ $child->tutor->user->firstname }} {{ $child->tutor->user->lastname }}</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Identifiant</th>
                                    <td>{{ $child->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sexe</th>
                                    <td>{{ $child->sexe === "Male" ? 'Garçon' : 'Fille' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de naissance</th>
                                    <td>{{ \Carbon\Carbon::parse($child->birth_date)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Classe</th>
                                    <td>{{ $child->classe->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Parent</th>
                                    <td>{{ $child->tutor->user->firstname }} {{ $child->tutor->user->lastname }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .card-header {
            background-color: #007bff; /* Couleur primaire */
            border-bottom: 1px solid #dee2e6;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        
        .rounded-circle {
            border-radius: 50%;
        }
        
        .btn-info, .btn-success {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@stop

@section('js')
@stop

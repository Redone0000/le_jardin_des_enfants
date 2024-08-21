@extends('adminlte::page')

@section('title', 'Classe')

@section('content_header')
    <h1>Classes</h1>
@stop

@section('content')
    <div class="container mt-4">
        @if(isset($classSections) && $classSections->isNotEmpty())
            @foreach($classSections as $class)
                @php
                    $childrenInClass = $user->tutor->children->where('class_id', $class->id);
                @endphp

                @foreach($childrenInClass as $child)
                    <div class="card mb-4 border-primary">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">{{ $child->firstname }} {{ $child->lastname }} - Classe: {{ $class->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Enseignant</th>
                                                <td>{{ $class->teacher->user->firstname }} {{ $class->teacher->user->lastname }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Section</th>
                                                <td>{{ $class->section->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Classe</th>
                                                <td>{{ $class->name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('storage/' . $class->teacher->picture) }}" alt="Photo" class="img-fluid rounded-circle" width="150">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <p class="mb-0">
                                Dernière mise à jour: 
                                {{ $class->updated_at ? $class->updated_at->format('d/m/Y H:i') : 'Non disponible' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @else
            <div class="alert alert-info" role="alert">
                Aucune classe trouvée.
            </div>
        @endif
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
        
        .rounded-circle {
            border-radius: 50%;
        }
    </style>
@stop

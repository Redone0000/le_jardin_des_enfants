@extends('adminlte::page')

@section('title', 'Créer un Partenaire')

@section('content_header')
    <h1>Créer un Partenaire</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nouveau Partenaire</div>

                    <div class="card-body">
                        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nom du Partenaire</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nom du partenaire" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Description du partenaire"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Adresse">
                            </div>

                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Téléphone">
                            </div>

                            <div class="form-group">
                                <label for="website">Site Web</label>
                                <input type="url" name="website" class="form-control" id="website" placeholder="https://example.com">
                            </div>

                            <div class="form-group">
                                <label for="picture">Image</label>
                                <input type="file" name="picture" class="form-control-file" id="picture">
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('partners.index') }}" class="btn btn-secondary">Annuler</a>
                        </form>
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
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
@stop

@section('js')
    <!-- Aucun JavaScript spécifique pour l'instant -->
@stop

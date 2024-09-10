@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-4 py-4 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center text-center">
        <h3 class="display-4 font-weight-bold text-white">Activité</h3>
        <div class="d-inline-flex text-white">
            <p class="mb-0"><a class="text-white" href="">Accueil</a></p>
            <p class="mb-0 mx-2">/</p>
            <p class="mb-0">Activité</p>
        </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('activity.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Créer une nouvelle activité</h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Classe field for admin -->
                        @if(auth()->check() && auth()->user()->role)
                            @if(auth()->user()->role_id === 1)
                            <div class="form-group">
                                <label for="classe" class="font-weight-bold">Classe</label>
                                <select name="classe" class="form-control custom-select">
                                    <option value="" disabled selected>Choisissez une classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>
                                            {{ $classe->name }} ({{ $classe->section->name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @elseif(auth()->user()->role->id === 2)
                                <input type="hidden" name="classe" value="{{ auth()->user()->teacher->classSection->id }}">
                            @endif
                        @endif

                        <!-- Type d'activité field -->
                        <div class="form-group">
                            <label for="type" class="font-weight-bold">Type d'activité</label>
                            <select name="type" class="form-control custom-select">
                                <option value="" disabled selected>Choisissez un type d'activité</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }} ({{ $type->category }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nom field -->
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nom</label>
                            <input type="text" name="name" class="form-control" placeholder="Nom de l'activité" value="{{ old('name') }}">
                        </div>

                        <!-- Description field -->
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Description">{{ old('description') }}</textarea>
                        </div>

                        <!-- Upload images -->
                        <div class="form-group">
                            <label for="pictures" class="font-weight-bold">Photos</label>
                            <input id="pictures" class="form-control-file" type="file" name="pictures[]" accept="image/*" multiple />
                        </div>

                        <!-- Upload videos -->
                        <div class="form-group">
                            <label for="videos" class="font-weight-bold">Vidéos</label>
                            <input id="videos" class="form-control-file" type="file" name="videos[]" accept="video/*" multiple />
                        </div>

                        <!-- Upload PDFs -->
                        <div class="form-group">
                            <label for="pdfs" class="font-weight-bold">PDFs</label>
                            <input id="pdfs" class="form-control-file" type="file" name="pdfs[]" accept=".pdf" multiple />
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

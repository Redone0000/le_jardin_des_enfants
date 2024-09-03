@extends('adminlte::page')

@section('title', 'Modifier l\'Événement')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-warning mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Modifier l'Événement</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="{{ route('event.index') }}">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Modifier</p>
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Modifier l'Événement : {{ $event->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nom de l'événement</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $event->name) }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="event_date">Date de l'événement</label>
                    <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date', $event->event_date) }}">
                </div>

                <!-- Affichage des fichiers existants -->
                <div class="form-group">
                    <h5>Fichiers associés :</h5>
                    @foreach($event->eventData as $data)
                        <div class="mb-2">
                            @if($data->isImage())
                                <div>
                                    <img src="{{ asset('storage/' . $data->file_path) }}" alt="Image" style="max-width: 200px;">
                                    <input type="checkbox" name="delete_files[]" value="{{ $data->id }}"> Supprimer
                                </div>
                            @elseif($data->isVideo())
                                <div>
                                    <video width="320" height="240" controls>
                                        <source src="{{ asset('storage/' . $data->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <input type="checkbox" name="delete_files[]" value="{{ $data->id }}"> Supprimer
                                </div>
                            @elseif($data->isPdf())
                                <div>
                                    <a href="{{ asset('storage/' . $data->file_path) }}" target="_blank">Télécharger le PDF</a>
                                    <input type="checkbox" name="delete_files[]" value="{{ $data->id }}"> Supprimer
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Champs pour ajouter de nouveaux fichiers -->
                <div class="form-group">
                    <label for="pictures">Photos</label>
                    <input id="pictures" class="form-control" type="file" name="pictures[]" accept="image/*" multiple />
                </div>

                <div class="form-group">
                    <label for="videos">Vidéos</label>
                    <input id="videos" class="form-control" type="file" name="videos[]" accept="video/*" multiple />
                </div>

                <div class="form-group">
                    <label for="pdfs">PDFs</label>
                    <input id="pdfs" class="form-control" type="file" name="pdfs[]" accept=".pdf" multiple />
                </div>

                <button type="submit" class="btn btn-primary">Sauvegarder les Modifications</button>
                <a href="{{ route('event.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@stop

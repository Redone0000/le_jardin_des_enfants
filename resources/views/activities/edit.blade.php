@extends('adminlte::page')

@section('title', 'Editer Activité')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Édition d'Activité</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Accueil</a></p>
            <p class="m-0"> / </p>
            <p class="m-0">Édition</p>
        </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('activity.update', $activity->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="border shadow p-4">
                @if(auth()->check() && auth()->user()->role)
                        @if(auth()->user()->role_id === 1)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classe">Classe</label>
                                    <select name="classe" class="form-control">
                                        <option value="" disabled>Choisissez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ $activity->classe_id == $classe->id ? 'selected' : '' }}>{{ $classe->name }} ({{ $classe->section->name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @elseif(auth()->user()->role->id === 2)
                            <input type="hidden" name="classe" value="{{ auth()->user()->teacher->classSection->id }}">
                        @endif
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type d'activité</label>
                                <select name="type" class="form-control">
                                    <option value="" disabled>Choisissez un type d'activité</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $activity->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }} ({{ $type->category }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" name="name" class="form-control" placeholder="Nom" value="{{ old('name', $activity->title) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description">{{ old('description', $activity->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                     <!-- Affichage des fichiers existants -->
            <div class="form-group">
                <label>Existing Files</label>
                <div>
                    <!-- Images -->
                    @foreach($activity->activityData->where('type', 'photo') as $data)
                        <img src="{{ asset('storage/' . $data->file_path) }}" alt="Photo" width="100" height="100">
                    @endforeach
                    <!-- Videos -->
                    @foreach($activity->activityData->where('type', 'video') as $data)
                        <video width="100" height="100" controls>
                            <source src="{{ asset('storage/' . $data->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endforeach
                    <!-- PDFs -->
                    @foreach($activity->activityData->where('type', 'pdf') as $data)
                        <a href="{{ asset('storage/' . $data->file_path) }}" download>Download PDF</a>
                    @endforeach
                </div>
            </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="pictures">Photos</label>
                            <input id="pictures" class="form-control" type="file" name="pictures[]" accept="image/*" multiple />
                        </div>
                    </div>

                    <div class="row">
                        <!-- video -->
                        <div class="col-md-6">
                            <label for="videos">Vidéos</label>
                            <input id="videos" class="form-control" type="file" name="videos[]" accept="video/*" multiple />
                        </div>
                    </div>
                    <div class="row">
                        <!-- pdf -->
                        <div class="col-md-6">
                            <label for="pdfs">PDFs</label>
                            <input id="pdfs" class="form-control" type="file" name="pdfs[]" accept=".pdf" multiple />
                        </div>
                    </div>

                    <!-- Display existing files if applicable -->
                    @if($activity->pictures)
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Photos Existantes</h5>
                                @foreach($activity->pictures as $picture)
                                    <img src="{{ asset('storage/' . $picture) }}" alt="Photo" class="img-thumbnail mb-2" style="max-width: 150px;">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($activity->videos)
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Vidéos Existantes</h5>
                                @foreach($activity->videos as $video)
                                    <video width="150" controls>
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Votre navigateur ne prend pas en charge la balise vidéo.
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($activity->pdfs)
                        <div class="row">
                            <div class="col-md-6">
                                <h5>PDFs Existants</h5>
                                @foreach($activity->pdfs as $pdf)
                                    <a href="{{ asset('storage/' . $pdf) }}" class="btn btn-link" target="_blank">Voir PDF</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary mt-3 ml-auto">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@extends('adminlte::page')

@section('title', 'Show Child')

@section('content_header')
    <h1 class="m-0">Détails de l’Activité</h1>
@stop

@section('content')
    <div class="container">
        <div class="row mt-5">
            <!-- Main content area -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="font-weight-bold">{{ $activity->title }}</h2>
                        <span class="badge badge-primary">{{ $activity->class->name }}</span>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row">Identifiant</th>
                                        <td>{{ $activity->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Type</th>
                                        <td>{{ $activity->activityType->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td>{{ $activity->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if($activity->activityData->isNotEmpty())
                            <div class="mt-4">
                                <h4 class="font-weight-bold">Données de l’Activité</h4>

                                <!-- Images -->
                                @if($activity->activityData->filter(fn($data) => $data->isImage())->isNotEmpty())
                                    <h5 class="mt-3 mb-2">Images</h5>
                                    <div class="row">
                                        @foreach($activity->activityData->filter(fn($data) => $data->isImage()) as $data)
                                            <div class="col-md-3 mb-3">
                                                <a href="{{ asset('storage/' . $data->file_path) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $data->file_path) }}" alt="Photo" class="img-fluid rounded">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Videos -->
                                @if($activity->activityData->filter(fn($data) => $data->isVideo())->isNotEmpty())
                                    <h5 class="mt-3 mb-2">Vidéos</h5>
                                    <div class="row">
                                        @foreach($activity->activityData->filter(fn($data) => $data->isVideo()) as $data)
                                            <div class="col-md-6 mb-3">
                                                <video class="w-100 rounded" controls>
                                                    <source src="{{ asset('storage/' . $data->file_path) }}" type="video/mp4">
                                                    Votre navigateur ne supporte pas la balise vidéo.
                                                </video>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- PDFs -->
                                @if($activity->activityData->filter(fn($data) => $data->isPdf())->isNotEmpty())
                                    <h5 class="mt-3 mb-2">PDFs</h5>
                                    <div class="row">
                                        @foreach($activity->activityData->filter(fn($data) => $data->isPdf()) as $data)
                                            <div class="col-md-3 mb-3">
                                                <a href="{{ asset('storage/' . $data->file_path) }}" class="btn btn-outline-primary btn-block" download>
                                                    <i class="fas fa-file-pdf"></i> Télécharger PDF
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="mt-3">Aucune donnée d’activité trouvée pour cette activité.</p>
                        @endif
                    </div>
                </div>

                <!-- Retour à la liste button -->
                <div class="mt-4">
                    <a href="{{ route('activity.index') }}" class="btn btn-info">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

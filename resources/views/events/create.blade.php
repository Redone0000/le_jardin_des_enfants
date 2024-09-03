@extends('adminlte::page')

@section('title', 'Créer un Événement')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-danger mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Créer un Nouvel Événement</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="{{ route('event.index') }}">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Créer</p>
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

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Nouveau Événement</div>
                <div class="card-body">
                    <form action="{{ route('event.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="form-group">
                            <label for="name">Nom de l'événement</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="event_date">Date de l'événement</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date') }}">
                        </div>

                        <!-- Champs pour EventData -->
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

                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('event.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

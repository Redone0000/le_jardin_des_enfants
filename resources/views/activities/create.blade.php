@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Activité</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0"></p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('activity.store') }}" enctype="multipart/form-data">
                @csrf

                <h5 class="mb-3"></h5>
                <div class="border shadow p-4">
                @if(auth()->check() && auth()->user()->role)
                        @if(auth()->user()->role_id === 1)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classe">Classe</label>
                                    <select name="classe" class="form-control">
                                        <option value="" disabled selected>Choisissez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>{{ $classe->name }} ({{ $classe->section->name }})</option>
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
                                    <option value="" disabled selected>Choisissez un type d'activité</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>{{ $type->name }} ({{ $type->category }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" name="name" class="form-control" placeholder="Nom" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <!-- <input type="text" name="description" class="form-control" placeholder="Description" value="{{ old('description') }}"> -->
                                <textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
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


                    <button type="submit" class="btn btn-primary mt-3 ml-auto">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

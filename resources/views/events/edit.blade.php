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
            <form action="{{ route('event.update', $event->id) }}" method="POST">
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

                <button type="submit" class="btn btn-primary">Sauvegarder les Modifications</button>
                <a href="{{ route('event.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@stop

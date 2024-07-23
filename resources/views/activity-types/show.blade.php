@extends('adminlte::page')

@section('title', 'Enseignant')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="container mt-5">
        <h1>Détails de l'Activité</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $activityType->name }}</h5>
                <p class="card-text"><strong>Catégorie:</strong> {{ $activityType->category }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $activityType->description }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('activity-types.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop